<?php

namespace App\Http\Controllers\Auth;

use App\Events\Registered;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function callback($driver)
    {
        $user = Socialite::driver($driver)->user();
        $isCurrentUserExist = User::where('email', $user->getEmail())->first();

        if ($isCurrentUserExist) {
            $newUser = $isCurrentUserExist;
            Session::regenerate();
        } else {
            $password = str::password(8);
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt($password),
                'driver_name' => $driver,
                'driver_id' => $user->getId(),
            ]);

            event(new Registered($newUser, $password, true));
        }

        Auth::login($newUser);
        Session::regenerate();
        return toastRedirect('intended', $user->getName() . ' عزیز، به بلاک‌زین خوش آمدید.');
    }
}
