<?php

namespace Modules\Collection\Enums;



use Modules\Morphling\Enums\HasSelectOptions;
use Modules\Morphling\Enums\HasValues;

enum CollectionColor: string
{
    use HasValues, HasSelectOptions;

    case Default = 'gray';
    case Green = 'green';
    case Violet = 'violet';
    case Orange = 'orange';
}
