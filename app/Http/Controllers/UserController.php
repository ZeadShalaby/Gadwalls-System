<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    // ?todo return all role
    public function role(Request $request)
    {
        //? Fetch all roles
        $roles = Role::all();

        //? Return the roles (you can also return a view or JSON response)
        return response()->json($roles);
    }

    /**
     * Display the product table.
     *
     * @param UserDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function table(UserDataTable $datatable)
    {
        return $datatable->render('data.index'); // Ensure the view name is correct
    }
    //

    // ??todo login page
    function loginindex()
    {
        return view('Auth.login');
    }



    // ?todo login to profile
    public function Login()
    {

    }


    // ?todo return info for user
    public function ProfileInfo()
    {

    }

    // ?todo logout in account
    public function Logout()
    {

    }


}
