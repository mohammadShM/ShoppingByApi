<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class categoryController extends ApiController
{

    public function index(): void
    {

    }

    public function store(Request $request,Category $category): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            "title" => 'required|string|unique:categories,title',
            "parent_id" => 'nullable|integer',
        ]);
        if ($validate->fails()) {
            return $this->errorResponse(422, $validate->messages());
        }
        $category->newCategory($request);
        $dataResponse = $category->orderBy('id', 'desc')->first();
        return $this->successResponse(200, new CategoryResource($dataResponse), 'Category Created Successfully');
    }

    public function show($id): void
    {

    }

    public function update(Request $request, $id): void
    {

    }

    public function destroy($id): void
    {

    }
}
