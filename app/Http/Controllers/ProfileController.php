<?php

namespace App\Http\Controllers;

use App\Services\Dashboard\FileUploaderService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    protected FileUploaderService $fileUploader;

    public function __construct(FileUploaderService $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    /*public function updatePersonal(Request $request)
    {
        $data = $this->validatePersonal($request->all());

        try {
            if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {

                $data['avatar'] = $this->fileUploader->upload($request->file('avatar'), false, true);
                $avatarFileExists = true;
                $this->updateProfile(Arr::only($data, ['bio', 'avatar']));

            } else {

                $this->updateProfile(Arr::only($data, ['bio']));
                $avatarFileExists = false;
            }

            $this->updateUser(Arr::only($data, ['name']));

            return response()->json([
                'message' => 'اطلاعات حساب کاربری شما با موفقیت بروزرسانی شد.',
                'type' => 'success',
                'avatarSrc' => $data['avatar'] ?? auth()->user()->profile->avatar,
                'avatarFileExists' => $avatarFileExists,
            ]);

        } catch (\Throwable $e) {

            report($e);

            return $this->showResponse('خطایی در ذخیره اطلاعات رخ داد. لطفاً دوباره تلاش کنید.', '', 'danger');
        }
    }*/

    public function updatePersonal(Request $request)
    {
        $data = $this->validatePersonal($request->all());

        $profileData = Arr::only($data, ['bio']);
        $userData    = Arr::only($data, ['name']);

        try {
            if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                $profileData['avatar'] = $this->fileUploader->upload($request->file('avatar'), false, true);
            }

            $this->updateUser($userData);
            $this->updateProfile($profileData);

            $user = auth()->user()->fresh('profile');

            return response()->json([
                'message' => 'اطلاعات حساب کاربری شما با موفقیت بروزرسانی شد.',
                'type' => 'success',
                'avatarSrc' => $user->profile->avatar,
                'avatarFileExists' => filled($user->profile->avatar),
            ]);

        } catch (\Throwable $e) {

            report($e);
            return $this->showResponse('خطایی در ذخیره اطلاعات رخ داد. لطفاً دوباره تلاش کنید.', '', 'danger');
        }
    }

    public function updateSocialLinks(Request $request)
    {
        $data = $this->validateSocialLinks($request->all());
        $this->updateProfile(['social_links' => $data]);

        return $this->showResponse('لینک‌های سوشال شما با موفقیت به‌روزرسانی شد.');
    }

    public function updateAvailability(Request $request)
    {
        try {
            $data = $this->validateAvailability($request);

            $availability = $data['availability'] ? ' نمایش پروفایل کاربری' : ' عدم نمایش پروفایل کاربری';

            $this->updateProfile($data);
            return $this->showResponse('تغییر وضعیت به :' . $availability);
        } catch (\Exception $e) {
        }
    }

    public function updatePassword(Request $request)
    {
        $data = $this->validatePassword($request->all());
        $this->isCurrentUserPassword($data['current_password']);
        $this->update($data['password']);

        Auth::logout();

        return $this->showResponse('رمزعبور شما با موفقیت تغییر کرد.', route('login'));
    }

    public function deleteAvatar(Request $request)
    {
        $profile = auth()->user()->profile;

        if ($profile->avatar) {
            $path = public_path('uploads/images/avatars/' . $profile->avatar);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        // null کردن مقدار در دیتابیس
        $profile->update(['avatar' => null]);

        return $this->showResponse('تصویر آواتار شما با موفقیت حذف شد.');
    }

    private function updateUser($data)
    {
        auth()->user()->update($data);
    }

    private function updateProfile($data)
    {
        auth()->user()->profile()->update($data);
    }

    private function isCurrentUserPassword($password): void
    {
        if (!Hash::check($password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'رمز عبور فعلی معتبر نمی‌باشد!',
            ]);
        }
    }

    private function update($password)
    {
        Auth::user()->update(['password' => Hash::make($password)]);
    }

    private function showResponse(string $message, string $redirect = '', string $type = 'success')
    {
        return response()->json([
            'message' => $message,
            'type' => $type,
            'redirect' => $redirect,
        ]);
    }

    private function validatePersonal($request)
    {
        return Validator::make($request, [
            'name' => ['required', 'min:3', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'bio' => ['nullable', 'min:10'],
        ])->validated();
    }

    private function validateSocialLinks($request)
    {
        return Validator::make($request, [
            'telegram' => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
            'linkedin' => ['nullable', 'url'],
        ])->validated();
    }

    private function validateAvailability(Request $request)
    {
        return $request->validate([
            'availability' => ['required', 'boolean'],
        ]);
    }

    private function validatePassword($request)
    {
        return Validator::make($request, [
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::min(8)->max(12)->symbols()->mixedCase()->numbers()]
        ])->validated();
    }

}
