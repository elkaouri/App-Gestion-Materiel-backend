<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


//STOCK//
Route::get('materiels', 'materielController@getMateriels');

Route::get('materiels/{data}', 'materielController@getMaterielsByVDP');

Route::post('getMaterielsInvoice', 'materielController@getMaterielsInvoice');

Route::get('materiel/{id}', 'materielController@getMateriel');

Route::post('insertMateriel', 'materielController@insertMateriel');

Route::post('editMateriel', 'materielController@editMateriel');

Route::delete('deleteMateriels/{id}', 'materielController@deleteMateriels');
Route::get('statistique', 'materielController@home');


//user
Route::post('login', 'userController@login');

Route::get('getusers', 'userController@getusers');

Route::post('insertUser', 'userController@insertUser');

Route::post('updateuser', 'userController@updateuser');

Route::delete('deleteusers/{id}', 'userController@deleteusers');

//type

Route::get('gettypes', 'typeController@gettypes');


Route::get('gettypesforselect', 'typeController@gettypesforselect');

Route::get('getSoustypes/{type}', 'typeController@getSoustypes');

Route::post('insertType', 'typeController@insertType');

Route::delete('deletetype/{id}', 'typeController@deletetype');
