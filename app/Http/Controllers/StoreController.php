<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\StoreDataTable;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    /**
     * Display the product table.
     *
     * @param StoreDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function table(StoreDataTable $datatable)
    {
        return $datatable->render('data.index'); // Ensure the view name is correct
    }
}
