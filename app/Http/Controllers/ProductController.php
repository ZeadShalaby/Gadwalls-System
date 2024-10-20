<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use App\Models\Supplier;
use Shuchkin\SimpleXLSX;
use App\Enums\ErrorEnums;
use App\Traits\ImageTrait;
use App\Traits\MethodTrait;
use League\Fractal\Manager;
use App\Traits\ImportFileTrait;
use League\Fractal\Resource\Item;
use App\Http\Requests\RequestExcel;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestProduct;
use App\Transformers\ProductTransformer;

class ProductController extends Controller
{
    use MethodTrait, ImportFileTrait, ImageTrait;


    protected $fractal;

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }


    /**
     * Display the product table.
     *
     * @param ProductDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function table(ProductDataTable $datatable)
    {
        $this->createSession('product.new');
        return $datatable->render('data.index'); // Ensure the view name is correct
    }
    // ?todo return view add product
    public function create()
    {
        $suppliers = Supplier::all();
        $stores = Store::all();
        return view('Data.NewRow.AddProduct', compact('suppliers', 'stores')); // Ensure the view name is correct
    }

    // ?todo store product
    public function store(RequestProduct $request)
    {
        $product = Product::create($request->all());
        $images = [];

        foreach ($request->file('files') as $file) {
            $path = $this->saveimage($file, '/images/product/');
            $images[] = $path;
        }
        $this->AddListMedia($product, $images);
        // $product->list_media = json_encode($images);


        //? notification
        $this->successNotification(ErrorEnums::SUCCESS->value, "Product : " . $product->name . " Added Successfully");
        return redirect()->route('product.table');
    }

    //?todo Show view with upload form
    public function excel()
    {
        return view('Excel.index');
    }

    //createProducts
    //?todo Upload Excel and call function to send certificates
    public function importExcel(RequestExcel $request)
    {
        try {
            $filePath = $request->file('file')->getRealPath();
            $xlsx = SimpleXLSX::parse($filePath);
            $data = $xlsx->rows();
            array_shift($data); //? Remove header row
            $count = $this->createProducts($data);
            $this->successNotification(ErrorEnums::SUCCESS->value, 'Products imported successfully.');
            //?todo transform data
            $resource = new Item($count, new ProductTransformer());
            $data = $this->fractal->createData($resource)->toArray();
            return response()->json($data);

        } catch (\Exception $e) {
            return back()->with('error', 'Error parsing the Excel file: ' . $e->getMessage());
        }
    }

    //?todo show product by id
    public function show(Product $product)
    {
        $product->load('media_one');
        return view('Data.ShowRow.product', compact('product'));
    }

    //?todo edit product 
    public function edit(Product $product)
    {
        return $product;
        return view('EditRow.product', compact('product', 'suppliers', 'stores'));
    }

    // ?todo update product
    public function update(RequestProduct $request, Product $product)
    {
        $product->update($request->all());
        //? notification
        $this->successNotification(ErrorEnums::SUCCESS->value, "Product : " . $product->name . " Updated Successfully");
        return redirect()->route('product.table');
    }
}
