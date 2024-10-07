<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SupplierDataTable;

class SupplierController extends Controller
{
    /**
     * Display the product table.
     *
     * @param SupplierDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function table(SupplierDataTable $datatable)
    {
        return $datatable->render('data.index'); // Ensure the view name is correct
    }
}
