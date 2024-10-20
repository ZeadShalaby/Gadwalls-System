<?php

namespace App\Http\Controllers;

use App\Traits\MethodTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SupplierDataTable;
use App\Http\Requests\RequestSupplier;
use Illuminate\Support\Facades\Session;

class SupplierController extends Controller
{
    use MethodTrait;
    /**
     * Display the product table.
     *
     * @param SupplierDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function table(SupplierDataTable $datatable)
    {
        $this->createSession('supplier.new');
        return $datatable->render('data.index'); // Ensure the view name is correct
    }

    public function create()
    {
        return view('Data.NewRow.AddProduct'); // Ensure the view name is correct
    }

    public function store(RequestSupplier $request)
    {

    }
}
