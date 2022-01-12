<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RoleCreateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function rules(): array
    {
        return [
           "title" =>"required",
            "permissions"=>"nullable|array|exists:permissions,id"
        ];
    }

    /** @noinspection ReturnTypeCanBeDeclaredInspection */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'validation errors',
            'data' => $validator->errors(),
        ]));
    }

}
