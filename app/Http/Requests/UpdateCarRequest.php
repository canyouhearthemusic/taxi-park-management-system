<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCarRequest extends FormRequest
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
            'firm' => ['required', 'string', 'min:2'],
            'model' => ['required', 'string', 'min:2'],
            'license_plate' => ['required', 'string', Rule::unique('cars', 'license_plate')->ignore($this->id)],
            'city' => ['required', Rule::exists('cities', 'id')]
        ];
    }
}
