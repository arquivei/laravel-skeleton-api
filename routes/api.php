<?php

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

use App\Http\Controllers\TestController;

Route::group(['prefix' => 'v1', 'middleware' => []], function () {
    Route::get('/test', [TestController::class, 'index'])->name('test.index');
});
