<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'body' => ['required', 'min:8', 'max:1000'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return toastRedirect('back', $validator->errors()->first(), 'danger');
    }

    public function authorize(): bool
    {
        return auth()->check();
    }
}
