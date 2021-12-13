<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $title
 * @property mixed $image
 * @property mixed $id
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class BrandResource extends JsonResource
{

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function toArray($request): array
    {
        /** @noinspection LaravelFunctionsInspection */
        return [
            "id" => $this->id,
            "title" => $this->title,
            "image" => url(env('IMAGE_UPLOADED_FOR_BRANDS') . $this->image),
//            "image" => $this->image,
//            "created_at" => $this->created_at,
//            "updated_at" => $this->updated_at,
            "products" => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
