<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest
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
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'path' => 'required|url',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:videos,slug' . $this->id,
            'uploaded_by' => '',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug(Str::lower($this->title))
        ]);
    }
}
