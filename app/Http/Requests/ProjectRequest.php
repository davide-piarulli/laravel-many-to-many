<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required|min:3|max:100',
            'link' => 'required|min:3|max:100',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.min' => 'Il titolo deve contenere minimo :min caratteri',
            'title.max' => 'Il titolo deve contenere massimo :max caratteri',
            'link.required' => 'Il link è obbligatorio',
            'link.min' => 'Il link deve contenere minimo :min caratteri',
            'link.max' => 'Il link deve contenere massimo :max caratteri',
        ];
    }
}
