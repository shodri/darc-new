<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'subtitle' => 'nullable|string|max:255',
            'text_button' => 'nullable|string|max:255',
            'text' => 'nullable|string',
            'href' => 'nullable|url|max:255',
            'section' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:1', // Se asume que es un número positivo
        ];
    }
}
