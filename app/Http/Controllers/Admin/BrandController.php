<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Admin\BrandResource;
use App\Models\Brand;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends ApiController
{
    public function index(): JsonResponse
    {
        $brands = Brand::all();
        return $this->successResponse(200, BrandResource::collection($brands), 'Brand Get Ok');
    }

    /**
     * @throws Exception
     */
    public function store(Request $request, Brand $brand): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            "title" => 'required|string|unique:brands,title',
            "image" => 'required|image',
        ]);
        if ($validate->fails()) {
            return $this->errorResponse(422, $validate->messages());
        }
        $brand->newBrand($request);
        $dataResponse = $brand->orderBy('id', 'desc')->first();
        return $this->successResponse(200, new BrandResource($dataResponse), 'Brand Created Successfully');
    }

    public function show(Brand $brand): JsonResponse
    {
        return $this->successResponse(200, new BrandResource($brand), 'GET' . '_' . $brand->title);
    }

    /**
     * @throws Exception
     */
    public function update(Request $request, Brand $brand): JsonResponse
    {
        $brandUnique = Brand::query()->where('title', $request->get('title'))
            ->where('id', '!=', $brand->id)->exists();
        if ($brandUnique) {
            return $this->errorResponse(422, 'The title has already been taken');
        }
        $validate = Validator::make($request->all(), [
            "title" => 'required|string',
            "image" => 'nullable|image',
        ]);
        if ($validate->fails()) {
            return $this->errorResponse(422, $validate->messages());
        }
        $brand->updatedBrand($request);
        return $this->successResponse(200, new BrandResource($brand), 'Brand updated Successfully');
    }

    public function destroy(Brand $brand): JsonResponse
    {
        $brand->delete();
        return $this->successResponse(200, $brand->title, 'Brand deleted Successfully');
    }

    public function getProducts(Brand $brand): JsonResponse
    {
        return $this->successResponse(200, new BrandResource($brand->load('products')),
            'get products successfully');
    }

}
