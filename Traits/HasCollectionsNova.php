<?php

namespace Modules\Collection\Traits;

use Laravel\Nova\Fields\MorphedByMany;
use Modules\Collection\Nova\Resources\Collection;

trait HasCollectionsNova
{
    public function collectionsField(): MorphedByMany
    {
        return MorphedByMany::make(__('Collections'), 'collections', Collection::class)
            ->searchable();
    }
}
