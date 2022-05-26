<?php

namespace Modules\Collection;

use Illuminate\Support\Collection;
use Modules\Collection\Services\CollectionService;
use Modules\Collection\Transformers\CollectionResource;
use Modules\Morphling\Contracts\Bootstrapper;


class CollectionBootstrapper implements Bootstrapper
{

    public function __construct(protected CollectionService $collectionService)
    {
    }

    public function boot(Collection $data, \Closure $next): Collection
    {
        $collections = $this->collectionService->all();

        $data->put('collections', CollectionResource::collection($collections));

        return $next($data);
    }
}
