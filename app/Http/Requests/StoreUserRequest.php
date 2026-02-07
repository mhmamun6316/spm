<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)],
            'status' => 'required|in:active,inactive',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
            'profile_photo' => 'nullable|file|mimes:jpeg,png,gif,webp|max:2048',
        ];
    }
}
