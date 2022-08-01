<?php

use Illuminate\Support\Facades\Route;
use Modules\Collection\Http\Controllers\Api\V1\CollectionChildrenController;
use Modules\Collection\Http\Controllers\Api\V1\CollectionParentController;
use Modules\Collection\Http\Controllers\Api\V1\CollectionsController;
use Orion\Facades\Orion;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1/'], function () {
    Orion::resource('collections', CollectionsController::class)->withSoftDeletes();
    Orion::belongsToResource('collections', 'parent', CollectionParentController::class)->withSoftDeletes();
    Orion::hasManyResource('collections', 'children', CollectionChildrenController::class)->withSoftDeletes();
});
