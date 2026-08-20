<?php

namespace App\Http\Controllers\Auth;

use App\Events\Registered;
use App\Events\Subscribed;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use App\Models\User;
use App\Rules\GoogleRecaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $this->validate($request);
        $user = User::create($data);

        if ($user) {
            Auth::login($user);
            $user->profile()->create();
            event(new Registered($user, $request->password));

            if ($request->subscribe) {
                Subscriber::updateOrCreate(['email' => $user->email]);
                event(new Subscribed($user));
            }

            return toastRedirect('index', $user->name . ' عزیز، خوش آمدید');
        } else {
            return toastRedirect('back', 'ثبت‌نام شما با مشکل مواجه شد.', 'danger');
        }
    }

    private function validate($request)
    {
        return $request->validate([
            'name' => ['required', 'min:3',],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)->max(12)->symbols()->mixedCase()->numbers()],
            //'g-recaptcha-response' => ['required', new GoogleRecaptcha('registerRecaptcha', 0.8)],
        ]);
    }
}
