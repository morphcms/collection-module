<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
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
        Schema::create(Table::collections(), function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Modules\Collection\Models\Collection::class)->nullable();
            $table->json('name'); // JSON to be translated
            $table->json('slug'); // JSON to be translated
            $table->json('meta')->nullable();
            $table->unsignedInteger('sort_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Table::collections());
    }
};
