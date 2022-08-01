<?php

namespace Modules\Collection\Utils;

use Modules\Morphling\Traits\TableHelper;

/**
 * @method static collections(string $column = null): string
 * @method static collectionables(string $column = null): string
 */
class Table
{
    use TableHelper;

    public static $configPath = 'collections.table_prefix';
}
