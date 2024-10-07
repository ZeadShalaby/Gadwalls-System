<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //
    /**
     * Display the product table.
     *
     * @param ProductDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function table(ProductDataTable $datatable)
    {
        return $datatable->render('data.index'); // Ensure the view name is correct
    }
    public function index()
    {
        return view('NewRow.AddProduct'); // Ensure the view name is correct
    }
}
