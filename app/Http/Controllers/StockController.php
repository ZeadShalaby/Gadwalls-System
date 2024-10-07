<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\StockDataTable;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    /**
     * Display the product table.
     *
     * @param StockDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function table(StockDataTable $datatable)
    {
        return $datatable->render('data.index'); // Ensure the view name is correct
    }

}
