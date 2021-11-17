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
        return [
            "id" => $this->id,
            "title" => $this->title,
            "image" => $this->image,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
