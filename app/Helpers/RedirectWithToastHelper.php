<?php

use Illuminate\Http\RedirectResponse;

if (!function_exists('toastRedirect')) {
    function toastRedirect($route, $message, $type = 'success'): RedirectResponse
    {
        if ($route === 'back') {
            return redirect()->back()->with('toast', [
                'message' => $message,
                'type' => $type
            ]);
        } elseif ($route === 'intended') {
            return redirect()->intended()->with('toast', [
                'message' => $message,
                'type' => $type
            ]);
        } else {
            return redirect()->route($route)->with('toast', [
                'message' => $message,
                'type' => $type
            ]);
        }
    }
}

if (!function_exists('createToast')) {
    function createToast($route, $entry, $createdObject): RedirectResponse
    {
        return $createdObject ? toastRedirect($route, "ایجاد {$entry} موردنظر با موفقیت انجام شد.")
            : toastRedirect($route, "ایجاد {$entry} مورد نظر با خطا مواجه شد.", 'danger');
    }
}

if (!function_exists('addToast')) {
    function addToast($route, $entry, $addedObject): RedirectResponse
    {
        return $addedObject ? toastRedirect($route, "{$entry} موردنظر با موفقیت اضافه شد(ند).")
            : toastRedirect($route, "اضافه کردن {$entry} مورد نظر با خطا مواجه شد.", 'danger');
    }
}

if (!function_exists('editToast')) {
    function editToast($route, $entry, $editedObject): RedirectResponse
    {
        return $editedObject ? toastRedirect($route, "ویرایش {$entry} با موفقیت انجام شد.")
            : toastRedirect($route, "ویرایش {$entry} با خطا مواجه شد.", 'danger');
    }
}

if (!function_exists('deleteToast')) {
    function deleteToast($route, $entry, $deletedObject): RedirectResponse
    {
        return $deletedObject ? toastRedirect($route, "حذف {$entry} موردنظر با موفقیت انجام شد.")
            : toastRedirect($route, "حذف {$entry} مورد نظر با خطا مواجه شد.", 'danger');
    }
}
