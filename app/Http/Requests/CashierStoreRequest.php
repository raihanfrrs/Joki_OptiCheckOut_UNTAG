<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashierStoreRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email:rfc,dns|unique:admins,email|unique:cashiers,email',
            'phone' => 'required|numeric|unique:admins,phone|unique:cashiers,phone',
            'pob' => 'required',
            'dob' => 'required|date',
            'gender' => 'required',
            'address' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required'
        ];
    }
}
