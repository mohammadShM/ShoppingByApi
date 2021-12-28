<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $title
 * @property mixed $parent_id
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class CategoryResource extends JsonResource
{

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "parent_id" => $this->parent_id,
            // when load parent show information parent
            "parent" => new CategoryResource($this->whenLoaded('parent')),
            // when load children show information children
            // "children" => CategoryResource::collection($this->whenLoaded('children')),
            "children" => self::collection($this->whenLoaded('children')),
            "products" => ProductResource::collection($this->whenLoaded('products')),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }

}
