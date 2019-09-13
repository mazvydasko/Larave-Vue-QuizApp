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

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group(['middleware' => ['admin']], function ($router) {
    Route::post('topic/new', 'TopicController@new');
    Route::put('topic/edit', 'TopicController@edit');
    Route::delete('topic/delete/{id}', 'TopicController@delete');

    Route::get('results', 'ResultsController@all');

    Route::get('questions', 'QuestionController@all');
    Route::post('question/new', 'QuestionController@new');
    Route::put('question/edit', 'QuestionController@edit');
    Route::delete('question/delete/{id}', 'QuestionController@delete');

    Route::get('answers', 'OptionsController@all');
    Route::put('answer/edit', 'OptionsController@edit');
    Route::delete('answer/delete/{id}', 'OptionsController@delete');
});


Route::get('topics', 'TopicController@all');
Route::get('topics/{id}', 'TopicController@get');
Route::post('results/new', 'ResultsController@new');
Route::post('user', 'UserController@new');
