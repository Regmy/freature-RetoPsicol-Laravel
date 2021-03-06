<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BuyerRequest extends FormRequest
{
    const UNPROCESSABLE_ENTITY = 422;

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
            //
            'name'              => 'required | min:3',
            'document'          => 'required | numeric | unique:buyers',
            'email'             => '',
            'branch_office_id'  => '',
            'ticket_buyed'      => '',
        ];
    }

    public function messages(){
        return [
            'name.required'         => 'El campo Nombre es olbigatorio',
            'name.min'              => 'El campo Nombre debe tener minimo 3 caracteres',
            'document.required'     => 'El campo Documento es olbigatorio',
            'document.numeric'      => 'El campo Documento debe ser numerico',
            'document.min'          => 'El campo Documento debe tener minimo 4 caracteres',
            'document.unique'       => 'El documento seleccionado ya se encuentra registrado',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), self::UNPROCESSABLE_ENTITY));
    }
}
