<?php

namespace Modules\Collection\Nova\Resources;

use App\Nova\Resource;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\Traits\HasTabs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Modules\Collection\Enums\CollectionColor;
use Modules\Collection\Models\Collection as CollectionModel;

class Collection extends Resource
{
    use HasTabs;

    public static string $model = CollectionModel::class;

    public static $title = 'name';

    public static $group = 'taxonomies';

    public static $search = [
        'name', 'slug'
    ];


    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Stack::make('Name', [
                Line::make('Name')->asHeading(),
                Line::make('Slug')->asBase(),
            ])->sortable()->exceptOnForms(),

            Text::make('Name')
                ->onlyOnForms()
                ->translatable()
                ->rulesFor('en','required'),

            Slug::make('Slug')
                ->from('Name')
                ->onlyOnForms()
                ->translatable()
                ->rulesFor('en','required'),

            BelongsTo::make('Parent Collection', 'parent', Collection::class)->nullable(),

            Select::make('Color')
                ->options(CollectionColor::options(nova: true))
                ->hideFromIndex()
                ->nullable()
                ->canSee(fn() => is_null($this->collection_id)),

            Tabs::make('Relations', [
                HasMany::make('Sub Collections', 'children', Collection::class),
            ]),
        ];
    }
}
