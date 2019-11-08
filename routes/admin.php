<?php

Route::view('/', 'admin.index')->name('admin');

Route::resource('categories', 'CategoriesController', ['names' => [
    'index'=>'categories.index',
    'create'=>'categories.create',
    'store'=>'categories.store',
    'show'=>'categories.show',
    'edit'=>'categories.edit',
    'update'=>'categories.update',
    'destroy'=>'categories.destroy'
]]);

Route::resource('clubs', 'ClubsController', ['names' => [
    'index'=>'clubs.index',
    'create'=>'clubs.create',
    'store'=>'clubs.store',
    'show'=>'clubs.show',
    'edit'=>'clubs.edit',
    'update'=>'clubs.update',
    'destroy'=>'clubs.destroy'
]]);

Route::resource('membres', 'MembersController', ['names' => [
    'index'=>'membres.index',
    'create'=>'membres.create',
    'store'=>'membres.store',
    'show'=>'membres.show',
    'edit'=>'membres.edit',
    'update'=>'membres.update',
    'destroy'=>'membres.destroy'
]]);

Route::resource('membre/{id}/score', 'ScoresController', ['names' => [
    'index'=>'scores.index',
    'create'=>'scores.create',
    'store'=>'scores.store',
    'show'=>'scores.show',
    'edit'=>'scores.edit',
    'update'=>'scores.update',
    'destroy'=>'scores.destroy'
]]);
Route::get('scores', 'ScoresController@showAll')->name('scores');

Route::resource('actualites', 'NewsController', ['names' => [
    'index'=>'actualites.index',
    'create'=>'actualites.create',
    'store'=>'actualites.store',
    'show'=>'actualites.show',
    'edit'=>'actualites.edit',
    'update'=>'actualites.update',
    'destroy'=>'actualites.destroy'
]]);

Route::resource('alertes', 'WarningsController', ['names' => [
    'index'=>'alertes.index',
    'create'=>'alertes.create',
    'store'=>'alertes.store',
    'show'=>'alertes.show',
    'edit'=>'alertes.edit',
    'update'=>'alertes.update',
    'destroy'=>'alertes.destroy'
]]);

Route::get('photos/{type}/{idtype}/', 'PicturesController@index')->name('photos.index');
Route::get('photos/{type}/{idtype}/{title}/create', 'PicturesController@create')->name('photos.create');
Route::post('photos/{type}/{idtype}/{title}', 'PicturesController@store')->name('photos.store');
Route::delete('photos', 'PicturesController@destroy')->name('photos.delete');

Route::get('videos/{type}/{idtype}/', 'VideosController@index')->name('videos.index');
Route::get('videos/{type}/{idtype}/create', 'VideosController@create')->name('videos.create');
Route::post('videos/{type}/{idtype}', 'VideosController@store')->name('videos.store');
Route::delete('videos', 'VideosController@destroy')->name('videos.delete');

Route::resource('typeTournois', 'TournamentTypesController', ['names' => [
    'index'=>'typeTournois.index',
    'create'=>'typeTournois.create',
    'store'=>'typeTournois.store',
    'show'=>'typeTournois.show',
    'edit'=>'typeTournois.edit',
    'update'=>'typeTournois.update',
    'destroy'=>'typeTournois.destroy'
]]);

Route::resource('tournois', 'TournamentsController', ['names' => [
    'index'=>'tournois.index',
    'create'=>'tournois.create',
    'store'=>'tournois.store',
    'show'=>'tournois.show',
    'edit'=>'tournois.edit',
    'update'=>'tournois.update',
    'destroy'=>'tournois.destroy'
]]);

// Rouge::get('tournois/{idtournament}/team/add', 'TournamentsController@addTeam')->name('tournois.addTeam');
// Route::get('tournois/{idtournament}/team/{idteam}', 'TournamentsController@editTeam')->name('tournois.editTeam');
Route::get('tournois/{id}/joueurs', 'TournamentsController@editPlayers')->name('tournois.editPlayers');
Route::post('tournois/{id}/joueurs', 'TournamentsController@updatePlayers')->name('tournois.updatePlayers');

Route::resource('tournois/{id}/equipe', 'TeamsController', ['names' => [
    'index'=>'teams.index',
    'create'=>'teams.create',
    'store'=>'teams.store',
    'show'=>'teams.show',
    'edit'=>'teams.edit',
    'update'=>'teams.update',
    'destroy'=>'teams.destroy'
]]);

Route::resource('liens', 'LinksController', ['names' => [
    'index'=>'liens.index',
    'create'=>'liens.create',
    'store'=>'liens.store',
    'show'=>'liens.show',
    'edit'=>'liens.edit',
    'update'=>'liens.update',
    'destroy'=>'liens.destroy'
]]);

Route::resource('partenaires', 'PartnersController', ['names' => [
    'index'=>'partenaires.index',
    'create'=>'partenaires.create',
    'store'=>'partenaires.store',
    'show'=>'partenaires.show',
    'edit'=>'partenaires.edit',
    'update'=>'partenaires.update',
    'destroy'=>'partenaires.destroy'
]]);

Route::resource('annonces', 'AdvertsController', ['names' => [
    'index'=>'annonces.index',
    'create'=>'annonces.create',
    'store'=>'annonces.store',
    'show'=>'.annonces.show',
    'edit'=>'annonces.edit',
    'update'=>'annonces.update',
    'destroy'=>'annonces.destroy'
]]);

Route::resource('evenements', 'EventsController', ['names' => [
    'index'=>'evenements.index',
    'create'=>'evenements.create',
    'store'=>'evenements.store',
    'show'=>'evenements.show',
    'edit'=>'evenements.edit',
    'update'=>'evenements.update',
    'destroy'=>'evenements.destroy'
]]);

Route::resource('ligues', 'LeaguesController', ['names' => [
    'index'=>'ligues.index',
    'create'=>'ligues.create',
    'store'=>'ligues.store',
    'show'=>'ligues.show',
    'edit'=>'ligues.edit',
    'update'=>'ligues.update',
    'destroy'=>'ligues.destroy'
]]);
Route::get('ligue/{id}/joueurs', 'LeaguesController@editPlayers')->name('ligues.editPlayers');
Route::post('ligue/{id}/joueurs', 'LeaguesController@updatePlayers')->name('ligues.updatePlayers');

Route::get('contacts', 'ContactsController@index')->name('contacts.index');
Route::post('contacts', 'ContactsController@update')->name('contacts.update');

Route::get('contentInformation', 'ContentInformationController@edit')->name('contentinformation.edit');
Route::patch('contentInformation', 'ContentInformationController@update')->name('contentinformation.update');


Route::resource('documents', 'DocumentsController', ['names' => [
    'index'=>'documents.index',
    'create'=>'documents.create',
    'store'=>'documents.store',
    'show'=>'documents.show',
    'edit'=>'documents.edit',
    'update'=>'documents.update',
    'destroy'=>'documents.destroy'
]]);

Route::resource('document-types', 'DocumentTypesController', ['names' => [
    'index'=>'documentTypes.index',
    'create'=>'documentTypes.create',
    'store'=>'documentTypes.store',
    'show'=>'documentTypes.show',
    'edit'=>'documentTypes.edit',
    'update'=>'documentTypes.update',
    'destroy'=>'documentTypes.destroy'
]]);