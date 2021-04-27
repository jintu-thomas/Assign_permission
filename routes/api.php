<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleManager;
use Spatie\Permission\Models\Role;
use App\Models\User;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'App\Http\Controllers\AuthController@register')
    ->name('register');

Route::post('login', 'App\Http\Controllers\AuthController@login')
    ->name('login');
Route::get('users', 'App\Http\Controllers\RoleManager@usersIndex')
    ->name('users.index');

Route::group([
    'middleware' => 'auth:api'
], function () {

    Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

    Route::get('permissions', 'App\Http\Controllers\RoleManager@permissionsIndex')
        ->name('permissions.index');
   

    // Route::post('/permissions/{permission}/assign/{user}', 'App\Http\Controllers\RoleManager@AddPermission');
    // Route::post('/permissions/{permission}/unassign/{user}', 'App\Http\Controllers\RoleManager@permissionsRemoveUser');

    Route::get('roles', 'App\Http\Controllers\RoleManager@rolesIndex')
        ->name('roles.index');

    Route::post('/roles/{role}/assign/{user}', 'App\Http\Controllers\RoleManager@rolesAddUser')
        ->name('roles.addUser');

    Route::post('/roles/{role}/unassign/{user}', 'App\Http\Controllers\RoleManager@rolesRemoveUser')
        ->name('roles.removeUser');

   

});