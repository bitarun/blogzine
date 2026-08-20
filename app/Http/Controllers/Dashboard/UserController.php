<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Dashboard\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\In;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $searchKey = $request->input('search');
        $status = $request->input('status');
        $role = $request->input('role');

        $data = $this->userService->get($searchKey, $status, $role);
        $users = $data['users'];
        $usersCount = $data['usersCount'];

        return view('dashboard.users.index', [
            'users' => $users->appends(['status' => $status, 'search' => $searchKey, 'role' => $role]),
            'usersCount' => $usersCount,
        ]);
    }

    public function create(Request $request)
    {
        try {
            $data = $this->createValidate($request);
            $this->userService->create($data);

            return response()->json([
                'type' => 'success',
                'message' => 'ثبت‌‌نام کاربر با موفقیت انجام شد.',
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function edit(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        try {
            $data = $this->editValidate($request, $user->id);
            $this->userService->update($user, $data);

            return response()->json([
                'type' => 'success',
                'message' => 'ویرایش کاربر با موفقیت انجام شد.',
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function destroy(User $user)
    {
        try {
            $this->userService->destroy($user);
            return response()->json([
                'type' => 'success',
                'message' => 'کاربر موردنظر با موفقیت حذف شد.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'danger',
                'message' => 'حذف کاربر "' . $user->name . '" با خطا مواجه گردید.',
            ]);
        }
    }

    private function createValidate(Request $request)
    {
        return validator($request->all(), [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->max(12)->symbols()->mixedCase()->numbers(),
            ],
        ])->validate();
    }

    private function editValidate(Request $request, int $id)
    {
        return validator($request->all(), [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'role' => ['required', new In(['subscriber', 'admin', 'author'])],
        ])->validate();
    }
}
