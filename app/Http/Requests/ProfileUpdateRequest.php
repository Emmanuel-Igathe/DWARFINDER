<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            // Profile fields
            'display_name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'gender' => ['required', 'in:male,female,non_binary,other'],
            'looking_for' => ['required', 'in:male,female,both,non_binary,all'],
            'height' => ['nullable', 'integer', 'min:50', 'max:250'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
        ];
    }
}
