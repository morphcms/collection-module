<?php

namespace Modules\Collection\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Morphling\Events\RegisterModulesNovaTools;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        RegisterModulesNovaTools::class => [

        ],
    ];
}
