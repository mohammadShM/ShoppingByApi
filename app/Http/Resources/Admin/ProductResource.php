<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function toArray($request): array
    {
        /** @noinspection PhpUndefinedFieldInspection */
        /** @noinspection LaravelFunctionsInspection */
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'name' => $this->name,
            // 'slug' => $this->slug, // for security not show slug in response
            'image' => url(env('IMAGE_UPLOADED_FOR_PRODUCTS') . $this->image),
            'price' => $this->price,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'galleries' => GalleryResource::collection($this->galleries),
        ];
    }
}
