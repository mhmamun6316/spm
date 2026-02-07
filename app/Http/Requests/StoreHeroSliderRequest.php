<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHeroSliderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => 'required',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
        ];
    }
}
