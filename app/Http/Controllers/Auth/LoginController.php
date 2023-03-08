<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    //    public function login(Request $request)
    //    {
    ////        dd($request->all());
    //
    //        $pass =  User::query()
    //            ->where([
    //                "email" => $request->get("email"),
    //            ])
    //            ->first()
    //            ->makeVisible("password")
    //            ->password;
    //
    //        $pass2 = Hash::check($request->get("password"), $pass);
    //
    //        return compact("pass", "pass2");
    //    }


    public function redirectTo()
    {
        \Log::debug('Login User: ' . auth()->user()->name);
        return RouteServiceProvider::defaultRoute(auth()->user());
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
