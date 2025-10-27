<?php

namespace App\Http\Requests\Link;

use Illuminate\Foundation\Http\FormRequest;

class MakeShortRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'original_url' => 'required|url|max:2048',
        ];
    }
}
