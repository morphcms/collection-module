<?php

namespace Modules\Collection\Http\Controllers\Api\V1;

use Modules\Collection\Models\Collection;
use Modules\Collection\Transformers\CollectionResource;
use Orion\Http\Controllers\RelationController;

class CollectionChildrenController extends RelationController
{
    protected $model = Collection::class;

    /**
     * Name of the relationship as it is defined on the Post model
     */
    protected $relation = 'children';

    protected $resource = CollectionResource::class;
}
