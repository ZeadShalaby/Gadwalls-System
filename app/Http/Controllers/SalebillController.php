<?php

namespace App\Http\Controllers;

use App\DataTables\SalebillDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalebillController extends Controller
{

    /**
     * Display the product table.
     *
     * @param SalebillDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function table(SalebillDataTable $datatable)
    {
        return $datatable->render('data.index'); // Ensure the view name is correct
    }

}
