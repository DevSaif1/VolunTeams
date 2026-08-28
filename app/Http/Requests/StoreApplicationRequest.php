<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('Member');
    }

    /**
     * Get the validation rules.
     */
    public function rules(): array
    {
        return [
            'opportunity_id' => [
                'required',
                'integer',
                'exists:opportunities,id',
            ],

            'reason' => [
                'required',
                'string',
                'max:1000',
            ],
        ];
    }
}