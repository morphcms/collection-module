<?php

namespace Modules\Collection\Http\Controllers\Api\V1;

use Modules\Collection\Http\Requests\CollectionRequest;
use Modules\Collection\Models\Collection;
use Modules\Collection\Transformers\CollectionResource;
use Orion\Http\Controllers\Controller;

class CollectionsController extends Controller
{
    protected $model = Collection::class;

    /**
     * @var string
     */
    protected $request = CollectionRequest::class;

    protected $resource = CollectionResource::class;

    /**
     * The relations that are allowed to be included together with a resource.
     *
     * @return array
     */
    public function includes(): array
    {
        return ['parent', 'children'];
    }

    /**
     * The list of available query scopes.
     *
     * @return array
     */
    public function exposedScopes(): array
    {
        return ['root', 'ordered'];
    }

    /**
     * The attributes that are used for searching.
     *
     * @return array
     */
    public function searchableBy(): array
    {
        $locale = app()->getLocale();

        return ["name->{$locale}", "slug->{$locale}"];
    }

    /**
     * The attributes that are used for sorting.
     *
     * @return array
     */
    public function sortableBy(): array
    {
        $locale = app()->getLocale();

        return ['id', "name->{$locale}"];
    }
}
