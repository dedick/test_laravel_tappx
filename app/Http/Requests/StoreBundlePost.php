<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBundlePost extends FormRequest
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
            'name' => [
                'required',
                'min:4',
                'regex:/(^(?=(.*[a-z0-9]){2,})([a-z0-9\_\-\s]{4,})$)/ui'
            ],
            'bundle' => [
                'required',
                'regex:/(^([a-z]{1}[a-z\d_]*\.)+[a-z][a-z\d_]*$)/i'
            ]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 'KO',
            'data' => $validator->errors()
        ], 422);
        throw new HttpResponseException($response);
    }

}
