<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminFoodRequest extends FormRequest
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
            'name' => 'required | max: 200',
            'description' => 'required',
            'ingredients' => 'required | max: 255',
            'price' => 'required',
            'visibility' => 'required',
            'path_img' => 'image',
        ];
    }
}
