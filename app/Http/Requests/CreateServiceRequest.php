<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
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
            "title" => ["string", "required", "max:100"],
            "description" => ["string", "required", "min:500"],
            "price" => ["numeric", "required", "min:5", "max:1000"],
            "miniature" => ["required", "image", "max:2000"],
            "category_id" => ["required", "exists:categories,id"],
        ];
    }
}
