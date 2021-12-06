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

    public function index(): JsonResponse
    {
        $category = Category::paginate(10);
        return $this->successResponse(200, [
            'categories' => CategoryResource::collection($category),
            'links' => CategoryResource::collection($category)->response()->getData()->links,
        ], 'get Categories');
    }

    public function store(Request $request, Category $category): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            "title" => 'required|string|unique:categories,title',
            "parent_id" => 'nullable|integer|exists:categories,id',
        ]);
        if ($validate->fails()) {
            return $this->errorResponse(422, $validate->messages());
        }
        $category->newCategory($request);
        $dataResponse = $category->orderBy('id', 'desc')->first();
        return $this->successResponse(200, new CategoryResource($dataResponse), 'Category Created Successfully');
    }

    public function show(Category $category): JsonResponse
    {
        return $this->successResponse(200, new CategoryResource($category), 'GET' . '_' . $category->title);
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        $categoryUnique = Category::query()->where('title', $request->get('title'))
            ->where('id', '!=', $category->id)->exists();
        if ($categoryUnique) {
            return $this->errorResponse(422, 'The title has already been taken');
        }
        $validate = Validator::make($request->all(), [
            "title" => 'required|string',
            "parent_id" => 'nullable|integer|exists:categories,id',
        ]);
        if ($validate->fails()) {
            return $this->errorResponse(422, $validate->messages());
        }
        $category->updatedCategory($request);
        return $this->successResponse(200, new CategoryResource($category), 'Category updated Successfully');
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return $this->successResponse(200, $category->title, 'Category deleted Successfully');
    }

    public function parent(Category $category): JsonResponse
    {
        // for set relation parent by $category->load('parent')
        return $this->successResponse(200,
            new CategoryResource($category->load('parent')), 'get parent');
    }

    public function children(Category $category): JsonResponse
    {
        // for set relation children by $category->load('children')
        return $this->successResponse(200,
            new CategoryResource($category->load('children')), 'get children');
    }

}
