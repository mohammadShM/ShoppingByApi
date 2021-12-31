<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
{

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function toArray($request): array
    {
        /** @noinspection PhpUndefinedFieldInspection */
        /** @noinspection LaravelFunctionsInspection */
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'path' => url(env('IMAGE_UPLOADED_FOR_GALLERIES') . $this->path),
            'mime' => $this->mime,
        ];
    }

}
