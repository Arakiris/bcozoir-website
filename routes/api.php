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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('calendrier', 'TournamentsController@eventcalendar')->name('eventcalendar');
Route::post('/classement-annee', 'TournamentsController@rankingYear')->name('rankingYear');
Route::post('/bcozoir-annee', 'TournamentsController@bcOzoirYear')->name('tournamentOzoirYear');
Route::post('/tournois-prive-annee', 'TournamentsController@privateYear')->name('tournamentsprivateYear');
Route::post('/championnats-annee', 'TournamentsController@championshipYear')->name('championshipsYear');
Route::post('/ligues-annee', 'LeaguesController@leaguesYear')->name('leaguesYear');
