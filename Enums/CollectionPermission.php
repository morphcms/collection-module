<?php

namespace Modules\Collection\Enums;

use Modules\Morphling\Enums\HasValues;

enum CollectionPermission: string
{
    use HasValues;

    case All = 'collections.*';
    case  ViewAny = 'collections.viewAny';
    case  View = 'collections.view';
    case  Create = 'collections.create';
    case  Update = 'collections.update';
    case  Delete = 'collections.delete';
    case  Replicate = 'collections.replicate';
    case  Restore = 'collections.restore';
}
