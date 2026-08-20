<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilesStoreRequest;
use App\Models\FileManager;
use App\Services\Dashboard\FileUploaderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileManagerController extends Controller
{
    public function index()
    {
        $files = FileManager::all();
        return view('dashboard.file-manager.index', compact('files'));
    }

    public function store(FilesStoreRequest $request, FileUploaderService $fileUploader)
    {
        $files = $request->validated();

        $uploadedFiles = $fileUploader->upload($files, false, false, true);

        $tableFields = array_map(function ($file) {

            return [
                'name' => $file,
                'created_at' => now(),
                'updated_at' => now(),
            ];

        }, $uploadedFiles);

        $addedFiles = FileManager::insert($tableFields);

        return addToast('file-manager.index', 'فایل(های)', $addedFiles);
    }

    public function destroy(Request $request)
    {
        if ($request->has('selectedFiles')) {
            foreach ($request->selectedFiles as $fileID) {
                $file = FileManager::findOrFail($fileID);
                File::delete(public_path('uploads/file_manager/' . $file->name));
                $deleted = $file->delete();
            }
            return deleteToast('file-manager.index', 'فایل(های)', $deleted);
        }

        return toastRedirect('back', 'فایلی برای حذف انتخاب نشده است!', 'danger');
    }
}
