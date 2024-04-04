<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use App\Models\City;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateCityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(Request $request): bool
    {
        return $request->user()->hasRole(UserRole::ADMIN);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('cities', 'name')->ignore($this->id)],
            'region' => ['required', 'integer', 'min:1', 'max:255']
        ];
    }
}
