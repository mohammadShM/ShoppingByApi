<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GalleryCreateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function rules(): array
    {
        return [
           "path.*" => 'required|image|mimes:jpg,jpeg,png,svg',
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
