<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRestaurantRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required | max: 100',
            'email' => 'required | max: 50',
            'phone_number' => 'required | max: 30',
            'vat_number' => 'required | max: 11',
            'address' => 'required | max: 50',
            'description' => 'required',
            'path_img' => 'image',
        ];
    }
}
