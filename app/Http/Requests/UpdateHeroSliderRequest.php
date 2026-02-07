<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHeroSliderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => 'nullable',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
        ];
    }
}
