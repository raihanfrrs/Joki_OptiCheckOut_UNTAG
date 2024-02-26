<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CashierUpdateRequest extends FormRequest
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
        $cashierId = $this->route('cashier');

        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email:rfc,dns', Rule::unique('admins')->ignore($cashierId), Rule::unique('cashiers')->ignore($cashierId)],
            'phone' => ['required', 'numeric', Rule::unique('admins')->ignore($cashierId), Rule::unique('cashiers')->ignore($cashierId)],
            'pob' => ['required'],
            'dob' => ['required', 'date'],
            'gender' => ['required'],
            'address' => ['required'],
            'username' => ['required', Rule::unique('users')->ignore($cashierId->user)],
        ];
    }
}
