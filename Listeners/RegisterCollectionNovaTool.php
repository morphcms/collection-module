<?php

namespace Modules\Collection\Listeners;

class RegisterCollectionNovaTool
{
    public function __invoke($event): array
    {
        return [
            \Modules\Collection\Nova\CollectionTool::make(),
        ];
    }
}
