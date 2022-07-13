<?php

namespace Modules\Collection\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use Modules\Collection\Nova\Resources\Collection;

class CollectionTool extends Tool
{
    protected static array $resources = [
        Collection::class,
    ];

    public function boot()
    {
        Nova::resources([
            Collection::class,
        ]);
    }

    public function menu(Request $request)
    {
        return null;
    }
}
