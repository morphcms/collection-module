<?php

namespace Modules\Collection\Traits;

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
}
