<?php

namespace Modules\Collection\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'color' => $this->color,
            'children' => $this->whenLoaded('children', fn () => CollectionResource::collection($this->children)),
            'parent' => $this->whenLoaded('parent', fn () => new CollectionResource($this->parent)),
            'to' => $this->whenLoaded('parent', fn () => $this->to()),
        ];
    }
}
