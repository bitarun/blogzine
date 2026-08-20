<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $this->validate($request);
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? toastRedirect('back', 'ایمیل بازیابی رمزعبور برای شما ارسال شد.')
            : toastRedirect('back', 'مشکلی در ارسال ایمیل برای شما پیش آمده است.', 'danger');
    }

    private function validate($request)
    {
        return $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);
    }
}
