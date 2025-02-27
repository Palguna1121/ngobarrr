<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePostsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:20'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            "title.required" => "Judul harus diisi!",
            "title.string" => "Judul harus berupa string!",
            "title.min" => "Judul minimal 5 karakter!",
            "title.max" => "Judul maksimal 20 karakter!",
            "description.required" => "Deskripsi harus diisi!",
            "description.string" => "Deskripsi harus berupa string!",
            "category.required" => "Kategori harus diisi!",
            "category.string" => "Kategori harus berupa string!",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'code' => 422,
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
