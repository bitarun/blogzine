<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $this->validateLogin($request);

        if (Auth::attempt($data, $request->boolean('remember'))) {

            $request->session()->regenerate();
            return toastRedirect(
                'index',
                auth()->user()->name . ' عزیز، خوش آمدید.'
            );
        }
        return toastRedirect(
            'back',
            'ورود شما با مشکل مواجه شد.',
            'danger'
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return toastRedirect('index', 'به امید دیدار مجدد شما');
    }

    private function validateLogin($request)
    {
        return $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    }
}
