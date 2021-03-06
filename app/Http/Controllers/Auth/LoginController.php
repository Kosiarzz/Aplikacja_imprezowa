<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        if(auth()->user()->role == 'user')
        {
            session(['avatar' => 'default/defaultAvatar.png']);

            if(auth()->user()->photos != null)
            session(['avatar' => auth()->user()->photos->path]);

            return RouteServiceProvider::USER;
        }
        else if(auth()->user()->role == 'business')
        {
            session(['avatar' => 'default/defaultAvatar.png']);
            
            if(auth()->user()->photos != null)
            session(['avatar' => auth()->user()->photos->path]);

            return RouteServiceProvider::BUSINESS;
        }
        else if(auth()->user()->role == 'moderator')
        {
            return RouteServiceProvider::MODERATOR;
        }
        else if(auth()->user()->role == 'admin')
        {
            return RouteServiceProvider::ADMIN;
        }

        return RouteServiceProvider::HOME;
    }
}
