<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class AuthAdminController extends Controller
{
    public function login()
    {
        return view('dashboard.auth.admin_login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credential = $request->only(['email', 'password']);
        $remember = $request->get('remember');

        if (auth('admin')->attempt($credential, $remember)) {
            return redirect()->route('index')->with('success', 'Logged in successfully');
        }
        return redirect()->back()->with('danger', 'Credential not correct');
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('index')->with('success', 'Logged out successfully');
    }
}
