<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOpportunityRequest extends FormRequest
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
            'team_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:teams,id',
            ],

            'title' => [
                'sometimes',
                'required',
                'string',
                'max:150',
            ],

            'description' => [
                'sometimes',
                'required',
                'string',
            ],

            'image_path' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'location' => [
                'nullable',
                'string',
                'max:255',
            ],

            'type' => [
                'sometimes',
                'required',
                'string',
                'max:20',
                'in:onsite,remote,hybrid',
            ],

            'start_date' => [
                'sometimes',
                'required',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'application_deadline' => [
                'nullable',
                'date',
                'before_or_equal:start_date',
            ],

            'required_volunteers' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'hours' => [
                'sometimes',
                'required',
                'numeric',
                'between:0.01,999.99',
            ],

            'status' => [
                'sometimes',
                'string',
                'max:20',
                'in:draft,published,closed,completed,cancelled',
            ],

            'is_active' => [
                'sometimes',
                'boolean',
            ],
        ];
    }
}