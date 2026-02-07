<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user')->id;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'status' => 'required|in:active,inactive',
            'approval_status' => 'required|in:pending,approved,rejected',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
            'profile_photo' => 'nullable|file|mimes:jpeg,png,gif,webp|max:2048',
            'remove_photo' => 'nullable|boolean',
        ];
    }
}
