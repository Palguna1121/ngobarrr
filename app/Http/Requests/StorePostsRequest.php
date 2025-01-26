<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostsRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:5', 'max:20'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string'],
        ];
    }

    public function messages()
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
}
