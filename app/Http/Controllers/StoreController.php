<?php

namespace App\Http\Controllers;

use App\Traits\MethodTrait;
use Illuminate\Http\Request;
use App\DataTables\StoreDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStore;
use Illuminate\Support\Facades\Session;

class StoreController extends Controller
{
    use MethodTrait;
    /**
     * Display the product table.
     *
     * @param StoreDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function table(StoreDataTable $datatable)
    {
        $this->createSession('store.new');
        return $datatable->render('data.index'); // Ensure the view name is correct
    }

    public function create()
    {
        return view('Data.NewRow.AddProduct'); // Ensure the view name is correct
    }

    public function store(RequestStore $request)
    {

    }
}
