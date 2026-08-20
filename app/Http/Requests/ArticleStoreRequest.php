<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\In;
use Illuminate\Validation\Validator;

class ArticleStoreRequest extends FormRequest
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
            'author_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'min:10'],
            'type' => ['required', new In(['breaking', 'incidents', 'multimedia', 'other', 'news', 'text'])],
            'category_id' => ['required', 'exists:categories,id'],
            'slug' => ['required', 'min:10', Rule::unique('articles', 'slug')->ignore($this->route('article'))],
            'status' => ['required'],
            'description' => ['nullable', 'min:30'],
            'body' => ['required', 'min:20'],
            'tags' => ['nullable'],
            'thumbnails' => ['nullable', 'max:2048', 'mimes:jpg,jpeg,png,gif'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'author_id' => auth()->id(),
        ]);

        $this->status ? $this->merge(['status' => 'pending']) : $this->merge(['status' => 'published']);
    }

    protected function withValidator(Validator $validator): void
    {
        /*$validator->after(function () {

            $image = $this->thumbnail_name;

            if (File::exists(public_path('uploads/images/thumbnails/small/' . $image))) {
                $this->files->remove('thumbnails');
            }
            $this->request->remove('thumbnail_name');
        });*/
    }
}
