<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('user/login');
    }

    public function postLogin(Request $request)
    {
        $userData = $request->except('_token');
        if (Auth::attempt($userData)) {
            return redirect()->route('posts.all');
        } else {
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function register()
    {
        return view('user/register');
    }

    public function postRegister(Request $request)
    {
        $user = new User($request->all());
        $user->password = bcrypt($request->input('password'));
        $user->save();
        Auth::login($user);
        return redirect()->route('posts.all');
    }
}
