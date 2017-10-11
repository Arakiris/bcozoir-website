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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::view('/admin', 'admin.index')->middleware('auth')->name('admin');

Route::view('/admin/login', 'auth.login')->middleware('guest')->name('login');
Route::post('/admin/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');

Route::resource('admin/categories', 'CategoriesController', ['names' => [
    'index'=>'admin.categories.index',
    'create'=>'admin.categories.create',
    'store'=>'admin.categories.store',
    'show'=>'admin.categories.show',
    'edit'=>'admin.categories.edit',
    'update'=>'admin.categories.update',
    'destroy'=>'admin.categories.destroy'
]]);

Route::resource('admin/clubs', 'ClubsController', ['names' => [
    'index'=>'admin.clubs.index',
    'create'=>'admin.clubs.create',
    'store'=>'admin.clubs.store',
    'show'=>'admin.clubs.show',
    'edit'=>'admin.clubs.edit',
    'update'=>'admin.clubs.update',
    'destroy'=>'admin.clubs.destroy'
]]);

Route::resource('admin/membres', 'MembersController', ['names' => [
    'index'=>'admin.membres.index',
    'create'=>'admin.membres.create',
    'store'=>'admin.membres.store',
    'show'=>'admin.membres.show',
    'edit'=>'admin.membres.edit',
    'update'=>'admin.membres.update',
    'destroy'=>'admin.membres.destroy'
]]);

Route::resource('admin/membre/{id}/score', 'ScoresController', ['names' => [
    'index'=>'admin.scores.index',
    'create'=>'admin.scores.create',
    'store'=>'admin.scores.store',
    'show'=>'admin.scores.show',
    'edit'=>'admin.scores.edit',
    'update'=>'admin.scores.update',
    'destroy'=>'admin.scores.destroy'
]]);

Route::get('admin/scores', 'ScoresController@showAll')->name('admin.scores');

Route::resource('admin/actualites', 'NewsController', ['names' => [
    'index'=>'admin.actualites.index',
    'create'=>'admin.actualites.create',
    'store'=>'admin.actualites.store',
    'show'=>'admin.actualites.show',
    'edit'=>'admin.actualites.edit',
    'update'=>'admin.actualites.update',
    'destroy'=>'admin.actualites.destroy'
]]);

Route::resource('admin/alertes', 'WarningsController', ['names' => [
    'index'=>'admin.alertes.index',
    'create'=>'admin.alertes.create',
    'store'=>'admin.alertes.store',
    'show'=>'admin.alertes.show',
    'edit'=>'admin.alertes.edit',
    'update'=>'admin.alertes.update',
    'destroy'=>'admin.alertes.destroy'
]]);

Route::get('admin/photos/{type}/{idtype}/', 'PicturesController@index')->name('admin.photos.index');
Route::get('admin/photos/{type}/{idtype}/create', 'PicturesController@create')->name('admin.photos.create');
Route::post('admin/photos/{type}/{idtype}', 'PicturesController@store')->name('admin.photos.store');
Route::delete('admin/photos', 'PicturesController@destroy')->name('admin.photos.delete');

Route::get('admin/videos/{type}/{idtype}/', 'VideosController@index')->name('admin.videos.index');
Route::get('admin/videos/{type}/{idtype}/create', 'VideosController@create')->name('admin.videos.create');
Route::post('admin/videos/{type}/{idtype}', 'VideosController@store')->name('admin.videos.store');
Route::delete('admin/videos', 'VideosController@destroy')->name('admin.videos.delete');

Route::resource('admin/typeTournois', 'TournamentTypesController', ['names' => [
    'index'=>'admin.typeTournois.index',
    'create'=>'admin.typeTournois.create',
    'store'=>'admin.typeTournois.store',
    'show'=>'admin.typeTournois.show',
    'edit'=>'admin.typeTournois.edit',
    'update'=>'admin.typeTournois.update',
    'destroy'=>'admin.typeTournois.destroy'
]]);

Route::resource('admin/tournois', 'TournamentsController', ['names' => [
    'index'=>'admin.tournois.index',
    'create'=>'admin.tournois.create',
    'store'=>'admin.tournois.store',
    'show'=>'admin.tournois.show',
    'edit'=>'admin.tournois.edit',
    'update'=>'admin.tournois.update',
    'destroy'=>'admin.tournois.destroy'
]]);

Route::get('admin/tournois/{id}/joueurs', 'TournamentsController@editPlayers')->name('admin.tournois.editPlayers');
Route::post('admin/tournois/{id}/joueurs', 'TournamentsController@updatePlayers')->name('admin.tournois.updatePlayers');

Route::resource('admin/liens', 'LinksController', ['names' => [
    'index'=>'admin.liens.index',
    'create'=>'admin.liens.create',
    'store'=>'admin.liens.store',
    'show'=>'admin.liens.show',
    'edit'=>'admin.liens.edit',
    'update'=>'admin.liens.update',
    'destroy'=>'admin.liens.destroy'
]]);

Route::resource('admin/partenaires', 'PartnersController', ['names' => [
    'index'=>'admin.partenaires.index',
    'create'=>'admin.partenaires.create',
    'store'=>'admin.partenaires.store',
    'show'=>'admin.partenaires.show',
    'edit'=>'admin.partenaires.edit',
    'update'=>'admin.partenaires.update',
    'destroy'=>'admin.partenaires.destroy'
]]);

Route::resource('admin/annonces', 'AdvertsController', ['names' => [
    'index'=>'admin.annonces.index',
    'create'=>'admin.annonces.create',
    'store'=>'admin.annonces.store',
    'show'=>'admin.annonces.show',
    'edit'=>'admin.annonces.edit',
    'update'=>'admin.annonces.update',
    'destroy'=>'admin.annonces.destroy'
]]);

Route::resource('admin/evenements', 'EventsController', ['names' => [
    'index'=>'admin.evenements.index',
    'create'=>'admin.evenements.create',
    'store'=>'admin.evenements.store',
    'show'=>'admin.evenements.show',
    'edit'=>'admin.evenements.edit',
    'update'=>'admin.evenements.update',
    'destroy'=>'admin.evenements.destroy'
]]);

Route::resource('admin/ligues', 'LeaguesController', ['names' => [
    'index'=>'admin.ligues.index',
    'create'=>'admin.ligues.create',
    'store'=>'admin.ligues.store',
    'show'=>'admin.ligues.show',
    'edit'=>'admin.ligues.edit',
    'update'=>'admin.ligues.update',
    'destroy'=>'admin.ligues.destroy'
]]);

Route::get('admin/ligue/{id}/joueurs', 'LeaguesController@editPlayers')->name('admin.ligues.editPlayers');
Route::post('admin/ligue/{id}/joueurs', 'LeaguesController@updatePlayers')->name('admin.ligues.updatePlayers');