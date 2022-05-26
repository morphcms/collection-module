<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Collection\Models\Collection;
use Modules\Collection\Utils\Table;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Table::collectionables(), function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Collection::class);
            $table->string('collectionable_type');
            $table->foreignId('collectionable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Table::collectionables());
    }
};
