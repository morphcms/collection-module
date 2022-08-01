<?php

namespace Modules\Collection\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Modules\Collection\Models\Collection;
use Modules\Collection\Utils\Table;

/**
 * @mixin Model
 */
trait HasCollections
{
    public function collection(): MorphOne
    {
        return $this->morphOne(Collection::class, 'collectionable');
    }

    public function collections(): MorphToMany
    {
        return $this->morphToMany(Collection::class, 'collectionable', Table::collectionables());
    }

    public function scopeWhereInCollectionsBySlug(Builder $query, array $slugs, string $locale = null): Builder
    {
        $currentLocale = $locale ?? app()->getLocale();

        $query->whereHas('collections',
            fn (Builder $query) => $query->whereIn(
                Table::collections("slug->{$currentLocale}"),
                $slugs
            )
        );

        return $query;
    }

    public function scopeWhereInCollections($query, array $ids)
    {
        $query->whereHas('collections', fn ($query) => $query->whereIn(Table::collections('id'), $ids));

        return $query;
    }
}
