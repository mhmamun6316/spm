<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageContentRequest extends FormRequest
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
            'mission' => 'nullable|string',
            'values' => 'nullable|string',
            'company_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            
            // Footer validations
            'footer_description' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'footer_contact_email' => 'nullable|email',
            'uk_address' => 'nullable|string',
            'uk_email' => 'nullable|email',
            'hq_address' => 'nullable|string',
            'hq_email' => 'nullable|email',
            'nz_address' => 'nullable|string',
            'nz_email' => 'nullable|email',
            'copyright_text' => 'nullable|string|max:255',
        ];
    }
}
