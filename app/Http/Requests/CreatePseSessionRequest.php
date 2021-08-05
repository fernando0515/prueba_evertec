<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePseSessionRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'description' => ['nullable', 'string', 'max:255'],
            'currency' => ['required', 'string', 'min:3', 'max:3'],
            'amount' => ['required', 'numeric' ],
            'idForm' => ['required'],
            'person' => ['required'],
            'bank' => ['required', 'min:1'],
            'document' => ['required'],
            'documentType' => [
                'required',
                Rule::in(['CC', 'CE', 'NIT', 'PPN', 'SSN', 'LIC', 'TAX', 'CIP', 'TI']),
            ],
            'name'=> ['required'],
            'surname'=> ['required'],
            'email'=> ['required'],

        ];
    }
}
