<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address'  => 'required|string|max:255',
            'mobile'   => 'required|string|max:15',
            'type'     => 'required|in:1,2',
            'nic_front' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'nic_back' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'type' => 'required',
        ];
    }
}
