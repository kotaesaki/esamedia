<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        return redirect('/admin/login');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function loggedOut(Request $request)
    {
        return redirect('/admin/login');
    }

    public function username()
    {
        return 'login_id';
    }
    public function guestLogin()
    {
        $login_id = 'guest';
        $password = 'guestuser';

        if (Auth::attempt(['login_id' => $login_id, 'password' => $password])) {
            return redirect()->route('admin.showHome');
        }
        return redirect('/admin/login');
        
    }
}
