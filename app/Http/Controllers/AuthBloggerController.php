<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class AuthBloggerController extends Controller
{
    public function login()
    {
        return view('dashboard.auth.blogger_login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credential = $request->only(['email', 'password']);
        $remember = $request->get('remember');

        if (auth('blogger')->attempt($credential, $remember)) {
            return redirect()->route('index')->with('success', 'Logged in successfully');
        }
        return redirect()->back()->with('danger', 'Credential not correct');
    }

    public function logout()
    {
        auth('blogger')->logout();
        return redirect()->route('index')->with('success', 'Logged out successfully');
    }
}
