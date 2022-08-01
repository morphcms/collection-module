<?php

namespace Modules\Collection\Bootstrappers;

use JetBrains\PhpStorm\ArrayShape;
use Modules\Collection\Services\CollectionService;
use Modules\Collection\Transformers\CollectionResource;
use Modules\Morphling\Contracts\Bootstrapper;
use Modules\Morphling\Events\FrontendBootstrap;

class CollectionBootstrapper implements Bootstrapper
{
    public function __construct(protected CollectionService $collectionService)
    {
    }

    #[ArrayShape(['collections' => "\Illuminate\Http\Resources\Json\AnonymousResourceCollection"])]
    public function handle(FrontendBootstrap $event): array
    {
        $collections = $this->collectionService->all();

        return [
            'collections' => CollectionResource::collection($collections),
        ];
    }
}
