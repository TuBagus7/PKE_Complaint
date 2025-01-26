<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportCategoryRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'name' => 'required',
            'image' => 'required|file'
        ];
    }
}
