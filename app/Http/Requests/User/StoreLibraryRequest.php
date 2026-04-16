<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreLibraryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'geo_lat' => 'required|numeric|between:-90,90',
            'geo_lng' => 'required|numeric|between:-180,180',
        ];
    }

    public function messages(): array
    {
        return [
            'geo_lat.required' => 'Please select a location on the map.',
            'geo_lng.required' => 'Please select a location on the map.',
        ];
    }
}