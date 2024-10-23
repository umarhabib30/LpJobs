<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
     * role 1 for the admin
     * role 2 for the employee
     * role 3 for the customer
     * @var string
     */
    public function redirectTo()
    {
        switch (Auth::user()->role) {
            case 1:
                return '/admin/dashboard';
                break;
            case 2:
                return '/employee/dashboard';
                break;
            case 3:
                return '/customer/dashboard';
                break;
            default:
                return '/';
        }
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
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()->with('error','Invalid credentials');
    }
}
