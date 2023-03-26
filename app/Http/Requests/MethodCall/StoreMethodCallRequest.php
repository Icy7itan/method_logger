<?php

namespace App\Http\Requests\MethodCall;

use Illuminate\Foundation\Http\FormRequest;

class StoreMethodCallRequest extends FormRequest
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
            'method_id'=>[
                'exists:App\Models\Method,id',
                'numeric',
            ],
            'lead_time_seconds'=>[
                'numeric',
                'nullable',
                'required_without_all:memory_usage_bit'
            ],
            'memory_usage_bit'=>[
                'numeric',
                'nullable',
                'required_without_all:lead_time_seconds'
            ],
        ];
    }
}
