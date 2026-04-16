<?php

namespace App\Http\Requests\Books;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'library_id' => 'required|exists:libraries,id',
            'category' => 'required|string|max:100',
            'isbn' => 'required|string|max:13|unique:books,isbn',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric|min:0',
            'rental_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',            
        ];
    }
}
