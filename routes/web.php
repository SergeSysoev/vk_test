<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ 'as' => 'home', 'uses' => 'App\IndexController@index' ]);
Route::get('/cities', [ 'as' => 'cities.get', 'uses' => 'App\IndexController@cities' ]);

Route::group([
	'namespace' => 'Vk',
], function () {
	Route::get('/login', [ 'as' => 'vk.login', 'uses' => 'LoginController@index' ]);
	Route::get('/store', [ 'as' => 'vk.store', 'uses' => 'LoginController@storeAccessToken' ]);
});

Route::group([
	'namespace' => 'App',
	'prefix' => 'polls',
], function () {
	Route::get('/my', [ 'as' => 'polls.my', 'uses' => 'PollController@my' ]);
	Route::get('/create', [ 'as' => 'poll.create', 'uses' => 'PollController@create' ]);
	Route::post('/create', [ 'as' => 'poll.store', 'uses' => 'PollController@store' ]);
	Route::get('/{id}', ['as' => 'poll.edit', 'uses' => 'PollController@edit']);
	Route::patch('/{id}', ['as' => 'poll.update', 'uses' => 'PollController@update']);
	Route::delete('/{id}', ['as' => 'poll.destroy', 'uses' => 'PollController@destroy']);
});
Route::group([
	'namespace' => 'App',
	'prefix' => 'votes',
], function () {
	Route::get('/', [ 'as' => 'votes', 'uses' => 'VoteController@index' ]);
	Route::post('/vote/{id}', [ 'as' => 'vote.store', 'uses' => 'VoteController@vote' ]);
	Route::delete('/vote/{id}', ['as' => 'vote.cancel', 'uses' => 'VoteController@cancel']);
});
Route::group([
	'namespace' => 'App',
	'prefix' => 'stats',
], function () {
	Route::get('/poll/{id}', [ 'as' => 'stats', 'uses' => 'StatController@index' ]);
	Route::get('/poll/{id}/filter', [ 'as' => 'stats.filter', 'uses' => 'StatController@filter' ]);
});