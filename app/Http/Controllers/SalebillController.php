<?php

namespace App\Http\Controllers;

use App\Enums\TaxEnums;

use App\Models\Product;
use App\Models\Salebill;
use App\Traits\MethodTrait;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use App\Traits\FatoorahTrait;
use App\Services\PriceCalculator;
use League\Fractal\Resource\Item;
use App\Services\SalebillServices;
use App\Http\Controllers\Controller;
use App\DataTables\SalebillDataTable;
use App\Transformers\CodeTransformer;
use App\Http\Requests\RequestSalebill;
use App\Http\Requests\RequestOrderList;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SalebillController extends Controller
{
    use MethodTrait, FatoorahTrait;


    protected $fractal;

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }


    /**
     * Display the product table.
     *
     * @param SalebillDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function table(SalebillDataTable $datatable)
    {
        $this->createSession('salebill.new');
        return $datatable->render('data.index'); // Ensure the view name is correct
    }



    // ?todo create view  
    public function create()
    {
        return view('Data.NewRow.AddSalbill'); // Ensure the view name is correct
    }


    // ?todo return info for code product
    public function infocode($code)
    {

        $product = Product::where('code', $code)->first();

        if ($product) {
            // $resource = new Item($product, new CodeTransformer());
            // $data = $this->fractal->createData($resource)->toArray();
            // return response()->json($data);
            return response()->json([
                'product_name' => $product->name,
                'quantity' => $product->quantity,
                'price' => $product->price,
                'store' => $product->store,
                'supplier' => $product->supplier,
                'rival' => $product->rival_one
            ]);
        }
        return response()->json(['message' => 'Product not found'], 404);

    }


    // ?todo calculate price
    public function calculatePrice(RequestSalebill $request)
    {
        $priceCalculator = new PriceCalculator();

        $price = (float) $request->price;
        $tax = 0;
        $discount = 0;
        $selectedTaxOption = $request->tax_option[0] ?? 1;
        $selectedCalculationOption = $request->selected_option ?? 5;

        if ($selectedTaxOption == TaxEnums::TAXINCLUDED->value) {
            $tax = 0;
        } elseif ($selectedTaxOption == TaxEnums::TAXEXCLUDED->value) {
            $tax = (15 * $request->quantity);
        }

        if ($request->has('rival')) {
            $discount = (float) $request->rival * $request->quantity;
        }


        // return $price . " " . $tax . " " . $discount . " " . $selectedCalculationOption . " " . $selectedTaxOption;
        $calculatedPrice = $priceCalculator->calculate($price, $tax, $discount, $selectedCalculationOption, $selectedTaxOption);

        return response()->json([
            'calculated_price' => $calculatedPrice,
        ]);
    }

    public function store(RequestOrderList $request)
    {
        try {

            $orders = json_decode($request->orderList, true);

            if (empty($orders)) {
                return response()->json(['success' => false, 'message' => 'No orders found']);
            }

            foreach ($orders as &$order) { // Use reference to modify the original array
                $order['selected_option_name'] = Salebill::getOptionNameByValue($order['selected_option']);
                if (isset($order['tax_option'])) {
                    $order['taxAmount'] = Salebill::getOptionNameByValue($order['tax_option']);
                }
                $order['tax'] = (15 * $order['quantity']);
            }

            //?todo Create sale bill using the service class
            $salebillServices = new SalebillServices();
            $ids = $salebillServices->create($orders);

            Session::forget('link');
            Session::put('link', env('BASE_URL') . route('salebill.new', $ids[0], false));

            return response()->json([
                'success' => true,
                'message' => 'Orders created successfully',
                'redirectUrl' => route('print.content'),
                'data' => [
                    'orders' => $orders,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to process orders',
                'error' => $e->getMessage(),
            ]);
        }
    }



    public function printfatoorah()
    {
        $data = Session::get('link');
        $qrCode = $this->generateQrCode($data);

        return view('fatoorah.fatoorah', compact('qrCode'));
    }








}
