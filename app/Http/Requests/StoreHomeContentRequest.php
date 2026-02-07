<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHomeContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|in:text,text_image',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'text_position' => 'required|in:left,center,right',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
            'image' => 'nullable|required_if:type,text_image|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_position' => 'nullable|required_if:type,text_image|in:left,right,top,bottom',
            'footer' => 'nullable|string',
        ];
    }
}
