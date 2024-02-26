<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
        $user = auth()->user();

        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email:rfc,dns', Rule::unique('admins')->ignore($user), Rule::unique('cashiers')->ignore($user)],
            'phone' => ['required', 'numeric', Rule::unique('admins')->ignore($user), Rule::unique('cashiers')->ignore($user)],
            'pob' => ['required'],
            'dob' => ['required', 'date'],
            'gender' => ['required'],
            'address' => ['required']
        ];
    }
}
