<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreResidentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *

    
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|file',
        ];
    }
}
