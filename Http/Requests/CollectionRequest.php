<?php

namespace Modules\Collection\Http\Requests;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Validation\Rule;
use Modules\Collection\Utils\Table;
use Orion\Http\Requests\Request;

class CollectionRequest extends Request
{
    public function commonRules(): array
    {
        $locale = config('app.locale', 'en');

        return [
            'name' => ['required', "array:$locale", 'min:1'],
            'name.*' => ['nullable'],
            "name.$locale" => ['required'],
            'meta' => ['nullable', 'meta'],
            'sort_order' => ['nullable', 'numeric', 'min:0'],
            'parent_id' => [
                Rule::exists(Table::collections(), 'id'),
            ],
        ];
    }

    public function storeRules(): array
    {
        return [
            'slug.*' => [
                UniqueTranslationRule::for(Table::collections(), 'slug'),
            ],
        ];
    }

    public function updateRules(): array
    {
        return [
            'slug.*' => [
                UniqueTranslationRule::for(Table::collections(), 'slug')->ignore($this->route('collection')),
            ],
        ];
    }
}
