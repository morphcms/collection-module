<?php

namespace Modules\Collection\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Acl\Utils\AclSeederHelper;
use Modules\Collection\Enums\CollectionPermission;

class CollectionDatabaseSeeder extends Seeder
{
    use AclSeederHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->acl('collections')
            ->attachEnum(CollectionPermission::class, CollectionPermission::All->value)
            ->create();

        if (app()->environment('local')) {
            $this->call(SampleDataTableSeeder::class);
        }
    }
}
