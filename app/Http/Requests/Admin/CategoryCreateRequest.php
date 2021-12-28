<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryCreateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function rules(): array
    {
        return [
            "title" => 'required|string|unique:categories,title',
            "parent_id" => 'nullable|integer|exists:categories,id',
        ];
    }

    /** @noinspection ReturnTypeCanBeDeclaredInspection */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'validation errors',
            'data' => $validator->errors(),
        ]));
    }

}
