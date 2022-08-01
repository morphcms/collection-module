<?php

namespace Modules\Collection\Listeners;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Nuwave\Lighthouse\Events\BuildSchemaString;
use Nuwave\Lighthouse\Schema\Source\SchemaStitcher;

class RegisterGraphQlSchema
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BuildSchemaString  $event
     * @return string
     *
     * @throws FileNotFoundException
     */
    public function handle(BuildSchemaString $event): string
    {
        $stitches = new SchemaStitcher(module_path('Collection', 'graphql/schema.graphql'));

        return $stitches->getSchemaString();
    }
}
