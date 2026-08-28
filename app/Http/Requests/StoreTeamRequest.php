<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Future purpose: Attach authorization policies (e.g., check if the user has permission to create a team).
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
            'manager_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],

            'name' => [
                'required',
                'string',
                'max:150',
                'unique:teams,name',
            ],

            'description' => [
                'required',
                'string',
            ],

            'logo_path' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'email' => [
                'nullable',
                'email',
                'max:150',
                'unique:teams,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:25',
            ],

            'address' => [
                'nullable',
                'string',
                'max:255',
            ],

            'is_active' => [
                'sometimes',
                'boolean',
            ],
        ];
    }
}