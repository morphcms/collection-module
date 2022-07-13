<?php

namespace Modules\Collection\Utils;

use Modules\Morphling\Traits\TableHelper;

/**
 * @method static collections(): string
 * @method static collectionables(): string
 */
class Table
{
    use TableHelper;

    public static $configPath = 'collection.table_prefix';
}
