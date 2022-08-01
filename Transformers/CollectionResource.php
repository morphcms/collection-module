<?php

namespace Modules\Collection\Transformers;

use Modules\Collection\Models\Collection;
use Orion\Http\Resources\Resource;

/**
 * @mixin Collection
 */
class CollectionResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        // Get Permissions =  $request->user() ?->getAllPermissions()->whereIn('name', CollectionPermission::values())->pluck('name'),

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            //'children_count' => $this->children()->count(),
            'children' => $this->whenLoaded('children', fn () => CollectionResource::collection($this->children)),
            'parent' => $this->whenLoaded('parent', fn () => new CollectionResource($this->parent)),
            'meta' => $this->meta,
        ];
    }
}
