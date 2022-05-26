<?php

namespace Modules\Collection\Utils;

class Table
{

    public static function collections(): string
    {
        return self::prefix('collections');
    }

    public static function collectionables(): string
    {
        return self::prefix('collectionables');
    }

    protected static function prefix($table): string
    {
        return config('collection.table_prefix') . $table;
    }
}
