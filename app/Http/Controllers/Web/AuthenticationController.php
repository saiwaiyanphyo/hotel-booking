<?php

namespace App\Http\Controllers\Web;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthenticationController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.home');
        }

        return redirect()->route('admin.login.form')->with('error', 'Invalid credentials');
    }

    /**
     * Show the application's login form.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function showLoginForm()
    {
        if (auth('admin')->check()) {
            return redirect()->route('admin.home');
        }

        return view('auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return RedirectResponse|mixed
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return redirect()->route('admin.login.form');
    }
}
