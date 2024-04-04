<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreWorkerRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:5', 'max:50'],
            'email' => ['required', 'string', 'email', 'min:10', 'max:70', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', 'min:5', 'max:70'],
            'role' => ['required', 'integer'],
            'city' => ['nullable', 'integer', 'exists:cities,id']
        ];
    }
}
