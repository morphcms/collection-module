<?php

namespace Modules\Collection\Services;

use Modules\Collection\Models\Collection;

class CollectionService
{
    public function whereInCollections($query, array $slugs, string $locale = null)
    {
        $query->whereHas('collections', fn ($query) => $query->whereIn('slug->'.$locale ?? app()->getLocale(), $slugs));

        return $query;
    }

    public function all()
    {
        return Collection::query()
            ->root()
            ->with('children', 'children.children', 'children.parent')
            ->get();
    }
}
