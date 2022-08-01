<?php

namespace Modules\Collection\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Collection\Listeners\RegisterCollectionNovaTool;
use Modules\Collection\Listeners\RegisterGraphQlSchema;
use Modules\Morphling\Events\BootModulesNovaTools;
use Nuwave\Lighthouse\Events\BuildSchemaString;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        BootModulesNovaTools::class => [
            RegisterCollectionNovaTool::class,
        ],
        BuildSchemaString::class => [
            RegisterGraphQlSchema::class,
        ],
    ];
}
