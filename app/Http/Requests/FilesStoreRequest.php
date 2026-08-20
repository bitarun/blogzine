<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilesStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'files' => ['required', 'array'],
            'files.*' => ['max:5120', 'mimes:jpg,jpeg,svg,png,gif,mp4,avi,mov,mkv,zip,rar,mp3,txt'],
        ];
    }
}
