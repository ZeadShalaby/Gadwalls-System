<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Enums\RoleEnums;
use App\Mail\Verifymail;
use App\Enums\ErrorEnums;
use App\Events\verifyEvent;
use App\Traits\MethodTrait;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Http\Requests\RequestUser;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RequestLogin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    use MethodTrait;
    // ??todo return all role
    public function role(Request $request)
    {
        //? Fetch all roles
        $roles = Role::all();

        //? Return the roles (you can also return a view or JSON response)
        return response()->json($roles);
    }

    // ???todo login page
    function home()
    {
        return view('Auth.home');
    }

    // ???todo login page
    function loginIndex()
    {
        return view('Auth.login');
    }

    // ?todo register page
    function registerIndex()
    {
        return view('Auth.Users.regist');
    }


    // ??todo Login Users
    public function login(RequestLogin $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);
            if (Auth::attempt($credentials)) {
                return redirect()->route('homeindex');
            } else {
                return back()->withInput()->withErrors(['password' => 'Invalid credentials']);
            }
        } catch (Exception $ex) {
            return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
        }
    }


    // ?todo add new account
    public function register(RequestUser $request)
    {
        try {
            $request['role'] = RoleEnums::USER->value;
            $customer = User::create($request->all());
            $this->Addmedia($customer, '/images/users/users.png');
            // ?todo Send mail -> user to verify it
            Mail::to($request->email)->send(new Verifymail($customer));
            $this->successNotification(ErrorEnums::SUCCESS->value, 'Please check your email to verifyed it' . $customer->name);
            return redirect()->route('user.table');
        } catch (Exception $ex) {
            return back()->with('error', "Some Thing Wrong .");
        }
    }

    // ?todo verify Email
    public function verfiy(User $user)
    {
        try {
            event(new verifyEvent($user));
            Auth::login($user);
            return redirect()->route('excel.index');

        } catch (Exception $ex) {
            return back()->withInput()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Display the product table.
     *
     * @param UserDataTable $datatable
     * @return \Illuminate\View\View
     */
    public function table(UserDataTable $datatable)
    {
        $this->createSession('user.new');
        return $datatable->render('data.index'); // Ensure the view name is correct
    }

    public function create()
    {
        return view('Data.NewRow.AddUser'); // Ensure the view name is correct
    }

    public function store(RequestUser $request)
    {

    }


    // ??todo return info for user
    public function ProfileInfo()
    {

    }

    // ??todo logout in account
    public function logout()
    {
        $this->createSession('logout');

        Auth::logout();
        return redirect()->route('loginindex');
    }


}
