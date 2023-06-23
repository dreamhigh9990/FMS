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

Route::post('/login', 'Api\AuthController@login');

Route::get('jobs', 'Api\JobController@get_jobs')->middleware('auth:api');
Route::post('job', 'Api\JobController@get_single_job')->middleware('auth:api');
Route::post('job_photos', 'Api\JobPhotosController@store')->middleware('auth:api');
Route::post('job_notes', 'Api\JobNotesController@store')->middleware('auth:api');
Route::post('update_job_status', 'Api\JobController@update_job_status')->middleware('auth:api');
Route::get('get_all_status', 'Api\StatusController@index')->middleware('auth:api');
Route::get('get_all_branches', 'Api\BranchesController@index')->middleware('auth:api');
