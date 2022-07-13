<?php

namespace Modules\Collection\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Modules\Collection\Database\Factories\CollectionFactory;
use Modules\Collection\Utils\Table;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Collection extends Model
{
    use HasFactory, HasTranslations, SoftDeletes, Searchable, HasTranslatableSlug;

    public array $translatable = ['name', 'slug'];

    protected $fillable = [
        'name',
        'slug',
        'color',
        'parent_id',
    ];

    protected static function newFactory(): CollectionFactory
    {
        return CollectionFactory::new();
    }

    public function getTable(): string
    {
        return Table::collections();
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }

    public function to(): string
    {
        return '/'.is_null($this->parent) ? '' : $this->parent->slug.'/'.$this->slug;
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('collection_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Collection::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
