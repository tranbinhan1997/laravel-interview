<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id' => 'required',
            'product_name' => 'required|string|max:50',
            'unit' => 'required',
            'price' => 'required|max:10',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'The category field is required.',
            'product_name.required' => 'The fruit item name field is required.',
            'product_name.max:50' => 'The fruit item name field must not be greater than 50 characters.',
        ];
    }
}
