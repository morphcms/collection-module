<?php

namespace Modules\Collection\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Modules\Collection\Models\Collection;
use Modules\Collection\Transformers\CollectionResource;

class IndexController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        $collections = Collection::query()->root()->with('children', 'children.children', 'children.parent')->get();

        return CollectionResource::collection($collections);
    }
}
