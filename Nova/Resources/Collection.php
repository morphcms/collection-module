<?php

namespace Modules\Collection\Nova\Resources;

use App\Nova\Resource;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\Traits\HasTabs;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Modules\Collection\Models\Collection as CollectionModel;
use Outl1ne\NovaSortable\Traits\HasSortableRows;

class Collection extends Resource
{
    use HasTabs, HasSortableRows;

    public static string $model = CollectionModel::class;

    public static $title = 'name';

    public static $group = 'taxonomies';

    public static $search = [
        'name', 'slug',
    ];

    public function fields(NovaRequest $request): array
    {
        $defaultLocale = config('app.locale', 'en');

        return [
            ID::make()->sortable(),

            Stack::make(__('Name'), [
                Line::make('Name')->asHeading(),
                Line::make('Slug')->asBase(),
            ])->sortable()->exceptOnForms(),

            Text::make(__('Name'), 'name')
                ->onlyOnForms()
                ->translatable()
                ->rulesFor($defaultLocale, 'required'),

            Slug::make(__('Slug'), 'slug')
                ->from("name.{$defaultLocale}")
                ->onlyOnForms()
                ->translatable()
                ->rulesFor($defaultLocale, 'required'),

            BelongsTo::make(__('Parent Collection'), 'parent', Collection::class)
                ->sortable()
                ->filterable()
                ->searchable()
                ->nullable(),

            Tabs::make('Relations', [
                HasMany::make(__('Sub Collections'), 'children', Collection::class),
            ]),
        ];
    }
}
