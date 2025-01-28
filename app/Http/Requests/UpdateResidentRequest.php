<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResidentRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //nullable === Boleh Kosong
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:8',
            'avatar' => 'nullable|file'
        ];
    }
}
