<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificateRequest extends FormRequest
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
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],

            'opportunity_id' => auth()->user()->hasRole('Team Manager')
            ? [
                'required',
                'integer',
                'exists:opportunities,id',
            ]
            : [
                'nullable',
                'integer',
                'exists:opportunities,id',
            ],

            'issued_by' => [
                'required',
                'integer',
                'exists:users,id',
            ],

            'file' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:5120',
            ],

            'verification_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'issued_at' => [
                'nullable',
                'date',
            ],
        ];
    }
}