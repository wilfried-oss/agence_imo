<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginFormRequest;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function login_perform(LoginFormRequest $request)
    {
        // $credentials = Arr::only($request->validated(), ['email', 'password']);
        $credentials = ($request->validated());
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.property.index'))->with('success', 'Login avec succes');
        }
        return back()->with('error', 'Identifiants invalides');
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login')->with('success', 'Déconnecté');
    }
}
