<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function toArray($request): array
    {
        /** @noinspection PhpUndefinedFieldInspection */
        return [
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'image' => $this->image,
            'description' => $this->description,
            'quantity' => $this->quantity,
        ];
    }
}
