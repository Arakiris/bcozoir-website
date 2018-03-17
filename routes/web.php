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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'DashboardController@index')->name('welcome');
Route::get('/version', 'DashboardController@version')->name('version');
Route::get('/mentions-legales', 'DashboardController@generalconditions')->name('generalconditions');
Route::get('/suggestions', 'DashboardController@proposal')->name('proposal');
Route::get('/plan', 'DashboardController@map')->name('map');

Route::get('/bcozoir', 'DashboardController@bcozoir')->name('bcozoir');
Route::get('/bureau', 'DashboardController@office')->name('office');
Route::get('/contact', 'DashboardController@contact')->name('contact');
Route::post('/contact', 'DashboardController@sendmail')->name('contact');
Route::get('/adresses', 'DashboardController@addresses')->name('adresses');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::view('/administration', 'admin.index')->middleware('auth')->name('admin');

Route::view('/administration/login', 'auth.login')->middleware('guest')->name('login');
Route::post('/administration/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::resource('administration/categories', 'CategoriesController', ['names' => [
    'index'=>'admin.categories.index',
    'create'=>'admin.categories.create',
    'store'=>'admin.categories.store',
    'show'=>'categories.show',
    'edit'=>'admin.categories.edit',
    'update'=>'admin.categories.update',
    'destroy'=>'admin.categories.destroy'
]]);

Route::resource('administration/clubs', 'ClubsController', ['names' => [
    'index'=>'admin.clubs.index',
    'create'=>'admin.clubs.create',
    'store'=>'admin.clubs.store',
    'show'=>'clubs.show',
    'edit'=>'admin.clubs.edit',
    'update'=>'admin.clubs.update',
    'destroy'=>'admin.clubs.destroy'
]]);

Route::resource('administration/membres', 'MembersController', ['names' => [
    'index'=>'admin.membres.index',
    'create'=>'admin.membres.create',
    'store'=>'admin.membres.store',
    'show'=>'membres.show',
    'edit'=>'admin.membres.edit',
    'update'=>'admin.membres.update',
    'destroy'=>'admin.membres.destroy'
]]);

Route::get('/membres', 'MembersController@showall')->name('members');

Route::resource('administration/membre/{id}/score', 'ScoresController', ['names' => [
    'index'=>'admin.scores.index',
    'create'=>'admin.scores.create',
    'store'=>'admin.scores.store',
    'show'=>'scores.show',
    'edit'=>'admin.scores.edit',
    'update'=>'admin.scores.update',
    'destroy'=>'admin.scores.destroy'
]]);
Route::get('administration/scores', 'ScoresController@showAll')->name('admin.scores');
Route::get('/listing', 'ScoresController@listingtable')->name('listing');

Route::resource('administration/actualites', 'NewsController', ['names' => [
    'index'=>'admin.actualites.index',
    'create'=>'admin.actualites.create',
    'store'=>'admin.actualites.store',
    'show'=>'actualites.show',
    'edit'=>'admin.actualites.edit',
    'update'=>'admin.actualites.update',
    'destroy'=>'admin.actualites.destroy'
]]);
route::get('/actualite/{id}/photos', 'NewsController@actualitephotos')->name('actualitePhotos');
route::get('/actualite/{id}/videos', 'NewsController@actualitevideos')->name('actualiteVideos');

Route::get('/actualites', 'NewsController@showall')->name('actualites');

Route::resource('administration/alertes', 'WarningsController', ['names' => [
    'index'=>'admin.alertes.index',
    'create'=>'admin.alertes.create',
    'store'=>'admin.alertes.store',
    'show'=>'alertes.show',
    'edit'=>'admin.alertes.edit',
    'update'=>'admin.alertes.update',
    'destroy'=>'admin.alertes.destroy'
]]);

Route::get('administration/photos/{type}/{idtype}/', 'PicturesController@index')->name('admin.photos.index');
Route::get('administration/photos/{type}/{idtype}/{title}/create', 'PicturesController@create')->name('admin.photos.create');
Route::post('administration/photos/{type}/{idtype}/{title}', 'PicturesController@store')->name('admin.photos.store');
Route::delete('administration/photos', 'PicturesController@destroy')->name('admin.photos.delete');

Route::get('administration/videos/{type}/{idtype}/', 'VideosController@index')->name('admin.videos.index');
Route::get('administration/videos/{type}/{idtype}/create', 'VideosController@create')->name('admin.videos.create');
Route::post('administration/videos/{type}/{idtype}', 'VideosController@store')->name('admin.videos.store');
Route::delete('administration/videos', 'VideosController@destroy')->name('admin.videos.delete');

Route::resource('administration/typeTournois', 'TournamentTypesController', ['names' => [
    'index'=>'admin.typeTournois.index',
    'create'=>'admin.typeTournois.create',
    'store'=>'admin.typeTournois.store',
    'show'=>'typeTournois.show',
    'edit'=>'admin.typeTournois.edit',
    'update'=>'admin.typeTournois.update',
    'destroy'=>'admin.typeTournois.destroy'
]]);

Route::resource('administration/tournois', 'TournamentsController', ['names' => [
    'index'=>'admin.tournois.index',
    'create'=>'admin.tournois.create',
    'store'=>'admin.tournois.store',
    'show'=>'admin.tournois.show',
    'edit'=>'admin.tournois.edit',
    'update'=>'admin.tournois.update',
    'destroy'=>'admin.tournois.destroy'
]]);
Route::get('/tournoi/{slug}', 'TournamentsController@showone')->name('tournois.show');
Route::get('/tournois-ozoir', 'TournamentsController@ozoirTournaments')->name('tournoisOzoir');
Route::get('/tournois-prives', 'TournamentsController@privateTournaments')->name('tournoisPrives');
Route::get('/championnats', 'TournamentsController@championships')->name('championnats');
Route::get('/tournoi/{slug}/listing', 'TournamentsController@tournamentlisting')->name('tournoiListing');
Route::get('/tournoi/{slug}/resultat', 'TournamentsController@report')->name('tournoiResultat');
Route::get('/tournoi/{slug}/photos', 'TournamentsController@tournamentpictures')->name('tournoiPhotos');
Route::get('/tournoi/{slug}/videos', 'TournamentsController@tournamentvideos')->name('tournoiVideos');
Route::get('/podiums', 'TournamentsController@showpodiums')->name('podiums');
Route::get('/podium/{slug}/photos', 'TournamentsController@podiumpictures')->name('podiumPhotos');
Route::get('/archives', 'TournamentsController@archiveschoice')->name('archiveschoix');
Route::get('/archives/tournois-ozoir', 'TournamentsController@oldOzoirTournaments')->name('vieuxtournoisOzoir');
Route::get('/archives/tournois-prives', 'TournamentsController@oldPrivateTournaments')->name('vieuxtournoisPrives');
Route::get('/archives/championnats', 'TournamentsController@oldChampionships')->name('vieuxchampionnats');

Route::get('administration/tournois/{id}/joueurs', 'TournamentsController@editPlayers')->name('admin.tournois.editPlayers');
Route::post('administration/tournois/{id}/joueurs', 'TournamentsController@updatePlayers')->name('admin.tournois.updatePlayers');

Route::resource('administration/liens', 'LinksController', ['names' => [
    'index'=>'admin.liens.index',
    'create'=>'admin.liens.create',
    'store'=>'admin.liens.store',
    'show'=>'liens.show',
    'edit'=>'admin.liens.edit',
    'update'=>'admin.liens.update',
    'destroy'=>'admin.liens.destroy'
]]);
Route::get('liens', 'LinksController@showall')->name('links');

Route::resource('administration/partenaires', 'PartnersController', ['names' => [
    'index'=>'admin.partenaires.index',
    'create'=>'admin.partenaires.create',
    'store'=>'admin.partenaires.store',
    'show'=>'partenaires.show',
    'edit'=>'admin.partenaires.edit',
    'update'=>'admin.partenaires.update',
    'destroy'=>'admin.partenaires.destroy'
]]);
Route::get('partenaires', 'PartnersController@showall')->name('partners');

Route::resource('administration/annonces', 'AdvertsController', ['names' => [
    'index'=>'admin.annonces.index',
    'create'=>'admin.annonces.create',
    'store'=>'admin.annonces.store',
    'show'=>'.annonces.show',
    'edit'=>'admin.annonces.edit',
    'update'=>'admin.annonces.update',
    'destroy'=>'admin.annonces.destroy'
]]);

Route::resource('administration/evenements', 'EventsController', ['names' => [
    'index'=>'admin.evenements.index',
    'create'=>'admin.evenements.create',
    'store'=>'admin.evenements.store',
    'show'=>'evenements.show',
    'edit'=>'admin.evenements.edit',
    'update'=>'admin.evenements.update',
    'destroy'=>'admin.evenements.destroy'
]]);
Route::get('/evenements', 'EventsController@showall')->name('evenements');
Route::get('/evenement/{slug}/photos', 'EventsController@eventpictures')->name('eventPhotos');
Route::get('/evenements/{slug}/videos', 'EventsController@eventvideos')->name('eventVideos');

Route::resource('administration/ligues', 'LeaguesController', ['names' => [
    'index'=>'admin.ligues.index',
    'create'=>'admin.ligues.create',
    'store'=>'admin.ligues.store',
    'show'=>'ligues.show',
    'edit'=>'admin.ligues.edit',
    'update'=>'admin.ligues.update',
    'destroy'=>'admin.ligues.destroy'
]]);
Route::get('administration/ligue/{id}/joueurs', 'LeaguesController@editPlayers')->name('admin.ligues.editPlayers');
Route::post('administration/ligue/{id}/joueurs', 'LeaguesController@updatePlayers')->name('admin.ligues.updatePlayers');
Route::get('/ligues', 'LeaguesController@showall')->name('ligues');
Route::get('/archives/ligues', 'LeaguesController@archivesleagues')->name('archivesligues');

Route::get('administration/contacts', 'ContactsController@index')->name('admin.contacts.index');
Route::post('administration/contacts', 'ContactsController@update')->name('admin.contacts.update');

// Route::get('/archivestest/tabtournaments', 'TournamentsController@oldOzoirTournamentsTest')->name('test');