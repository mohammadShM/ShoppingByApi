<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends ApiController
{

    public function index(): JsonResponse
    {
        $product = Product::paginate(10);
        return $this->successResponse(201, [
            'products' => ProductResource::collection($product),
            'links' => ProductResource::collection($product)->response()->getData()->links,
        ], 'get all products');
    }

    /**
     * @throws Exception
     */
    public function store(Request $request, Product $product): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            "category_id" => 'required|integer|exists:categories,id',
            "brand_id" => 'required|integer|exists:brands,id',
            "name" => 'required|string',
            "image" => 'required|image|mimes:png,jpg,jpeg,svg',
            "slug" => 'required|string|unique:products,slug',
            "price" => 'required|integer',
            "description" => 'required|string',
            "quantity" => 'required|integer',
        ]);
        if ($validate->fails()) {
            return $this->errorResponse(422, $validate->messages());
        }
        $product->newProduct($request);
        $responseData = $product->orderBy('id', 'desc')->first();
        return $this->successResponse(200, new ProductResource($responseData), 'product created successfully');
    }

    public function show(Product $product): JsonResponse
    {
        return $this->successResponse(200, new ProductResource($product),
            'GET ' . $product->name);
    }

    /**
     * @throws Exception
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            "category_id" => 'required|integer|exists:categories,id',
            "brand_id" => 'required|integer|exists:brands,id',
            "name" => 'required|string',
            "image" => 'nullable|image|mimes:png,jpg,jpeg,svg',
            "slug" => 'required|string',
            "price" => 'required|integer',
            "description" => 'required|string',
            "quantity" => 'required|integer',
        ]);
        if ($validate->fails()) {
            return $this->errorResponse(422, $validate->messages());
        }
        $slugUnique = Product::query()->where('slug', $request->get('slug'))
            ->where('id', '!=', $product->id)->exists();
        if ($slugUnique) {
            return $this->errorResponse(422, 'The slug has already been taken');
        }
        $product->updateProduct($request);
        return $this->successResponse(200, new ProductResource($product), $product->name . ' updated successfully');
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return $this->successResponse(200, new ProductResource($product), $product->name . ' deleted successfully');
    }

}
