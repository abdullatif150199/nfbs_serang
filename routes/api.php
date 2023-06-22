<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;

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

Route::get('/{slug}', function () {
    return response()->json('Not found', 404);
});

Route::get('/update',function () {
    return response()->json('halaman update');
});
