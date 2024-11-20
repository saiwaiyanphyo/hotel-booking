<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'employee/home';

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

        if (Auth::guard('employee')->attempt($credentials)) {
            return redirect()->route('employee.home');
        }

        return redirect()->route('employee.login.form')->with('error', 'Invalid credentials');
    }

    /**
     * Show the application's login form.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function showLoginForm()
    {
        if (auth('employee')->check()) {
            return redirect()->route('employee.home');
        }

        return view('employee.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('employee');
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

        return redirect()->route('employee.login.form');
    }
}
