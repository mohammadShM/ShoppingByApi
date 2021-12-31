<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Admin\GalleryCreateRequest;
use App\Http\Resources\Admin\GalleryResource;
use App\Models\Gallery;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GalleryController extends ApiController
{

    public function index(Product $product): JsonResponse
    {
        return $this->successResponse(200, GalleryResource::collection($product->galleries), 'images for product');
    }

    /**
     * @throws Exception
     */
    public function store(GalleryCreateRequest $request, Product $product): JsonResponse
    {
        $product->newGallery($request);
        return $this->successResponse(200, true, 'Down!');
    }

    public function show(Gallery $gallery): void
    {

    }

    public function update(Request $request, Gallery $gallery): void
    {

    }

    public function destroy(Product $product, Gallery $gallery): JsonResponse
    {
        $product->deleteGallery($gallery);
        return $this->successResponse(200, true, 'image deleted successfully');
    }

}
