<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeamRequest extends FormRequest
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
        // Extract team ID from route binding for unique exclusion
        $teamId = $this->route('team')?->id ?? $this->route('team');

        return [
            'manager_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:users,id',
            ],

            'name' => [
                'sometimes',
                'required',
                'string',
                'max:150',
                Rule::unique('teams', 'name')->ignore($teamId),
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
                Rule::unique('teams', 'email')->ignore($teamId),
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