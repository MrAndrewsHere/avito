<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdViewRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sortBy' => [Rule::in(['price', 'created_at'])],
            'descending' => ['boolean'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'descending' => (bool)$this->descending,
        ]);
    }
}
