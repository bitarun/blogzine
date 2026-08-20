<?php

namespace App\Http\Controllers\Auth;

use App\Events\PasswordChanged;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Password as FacadePassword;

class NewPasswordController extends Controller
{
    public function index($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    public function store(Request $request)
    {
        $this->validate($request);

        $status = FacadePassword::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordChanged($user, $password));
            }
        );


        return $status === FacadePassword::PASSWORD_RESET
            ? toastRedirect('login', 'کلمه عبور شما تغییر کرد اکنون می توانید با آن در سایت لاگین نمایید.')
            : toastRedirect('back', 'توکن بازیابی کلمه عبور معتبر نمی باشد!', 'danger');
    }

    private function validate($request): void
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Password::min(8)->max(12)->symbols()->mixedCase()->numbers()],
        ]);
    }
}
