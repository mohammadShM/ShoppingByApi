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
            "title" => 'required|string',
            "image" => 'required|image',
        ]);
        if ($validate->failed()) {
            return $this->errorResponse(422, $validate->messages());
        }
        $brand->newBrand($request);
        $dataResponse = $brand->orderBy('id', 'desc')->first();
        return $this->successResponse(200, new BrandResource($dataResponse), 'Brand Created Successfully');
    }

    public function show($id): void
    {
        //
    }

    public function update(Request $request, $id): void
    {
        //
    }

    public function destroy($id): void
    {
        //
    }
}
