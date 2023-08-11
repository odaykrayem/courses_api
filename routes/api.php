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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers\Api\V1\Auth'], function () {
    Route::post('register', 'UserAuthController@register');
    Route::post('login', 'UserAuthController@login');
    });
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function(){
    Route::post('delete_course/{id}', 'CourseController@delete');
    Route::post('delete_online_course/{id}', 'OnlineCourseController@delete');
    Route::post('delete_video/{id}', 'VideoController@delete');
    Route::post('delete_article/{id}', 'ArticleController@delete');
    Route::post('delete_c_participant/{id}', 'CParticipantController@delete');
    Route::post('delete_oc_participant/{id}', 'OCParticipantController@delete');
    Route::post('course_videos', 'CourseController@getCourseVideos');

    Route::apiResource('courses', CourseController::class);
    Route::apiResource('online_courses', OnlineCourseController::class);
    Route::apiResource('videos', VideoController::class);
    Route::apiResource('articles', ArticleController::class);
    Route::apiResource('cparticipants', CParticipantController::class);
    // Route::group(['prefix' => 'contests'], function(){
    //   Route::get('list', 'ContestController@list');
    // });

});
