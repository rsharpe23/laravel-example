<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');

Route::get('profile', 'ProfileController@show');
Route::put('profile', 'ProfileController@update');

// Контроллер одного действия
Route::get('link-targets', 'LinkTargetController');

Route::resource('portfolio', 'WorkController', [
    'except' => ['create', 'edit'],
]);

Route::resource('work-types', 'WorkTypeController', [
    'except' => ['create', 'edit'],
]);

Route::resource('attachments', 'AttachmentController', [
    'except' => ['create', 'edit', 'update'],
]);