<?php

namespace App\Http\Requests\Method;

use Illuminate\Foundation\Http\FormRequest;

class StoreMethodRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'method'=>[
                'string',
                'nullable',
                'required_without_all:route'
            ],
            'route'=>[
                'string',
                'nullable',
                'required_without_all:method'
            ],
        ];
    }
}
