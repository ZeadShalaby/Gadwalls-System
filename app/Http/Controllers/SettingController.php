<?php

namespace App\Http\Controllers;

use App\Traits\MethodTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestSetting;

class SettingController extends Controller
{
    use MethodTrait;
    //

    public function create()
    {
        $this->createSession('setting.create');
        return view('setting.index');
    }

    public function store(RequestSetting $request)
    {
        return $request;
    }

}
