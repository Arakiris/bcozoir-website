@extends('layouts.admin') 
@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des clubs du site internet </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Tournois</li>
        <li class="active">&Eacute;dition</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- left column -->
    <div class="col-xs-12">

        <!-- general form elements disabled -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">&Eacute;diter un tournoi</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/administration/tournois/{{ $tournament->id }}" enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <!-- select -->
                    <div class="form-group">
                        <label>Type de Tournois</label>
                        <select class="form-control" id="type_id" name="type_id" required>
                            @foreach($tournamentTypes as $type)
                                <option value="{{ $type->id }}" {{ ($type->id == $tournament->type_id) ? 'selected' : '' }}> {{ $type->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- text input -->
                    <div class="form-group">
                        <label for="start_season">Année de début de saison</label>
                        <input type="number" id="start_season" name="start_season" class="form-control" min="2000" value="{{ date('Y', strtotime($tournament->start_season)) }}" required>
                    </div>

                    <!-- text input -->
                    <div class="form-group">
                        <label for="title">Intitulé du tournoi</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Veuillez entrer l'intitulé nom du tournoi" value="{{ $tournament->title }}" required>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="place">Lieu du tournoi</label>
                        <input type="text" id="place" name="place" class="form-control" placeholder="Veuillez entrer le lieu du tournoi" value="{{ $tournament->place }}" required>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="date">Date du tournoi</label>
                        <input type="date" id="date" name="date" class="form-control" min="01-01-2000" value="{{ $tournament->date->format('Y-m-d') }}" required>
                    </div>

                    <div class="col-md-6">
                        <!-- radio -->
                        <div class="form-group">
                            <label for="is_accredited">Homologué ?</label>
                            <div class="radio radiobutton">
                                <label class="margin-right-15">
                                    <input type="radio" name="is_accredited" id="is_accredited" value="1" {{ ($tournament->is_accredited == 1) ? 'checked' : '' }}>
                                    Oui
                                </label>
                                <label>
                                    <input type="radio" name="is_accredited" id="is_accredited" value="0" {{ ($tournament->is_accredited == 0) ? 'checked' : '' }}>
                                    Non
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <!-- radio -->
                        <div class="form-group">
                            <label for="is_rules_pdf">Règle en PDF ou URL ?</label>
                            <div class="radio radiobutton">
                                <label class="margin-right-15">
                                    <input type="radio" name="is_rules_pdf" id="is_rules_pdf" value="0" {{ ($tournament->is_rules_pdf == 0) ? 'checked' : '' }}>
                                    URL
                                </label>
                                <label class="margin-right-15">
                                    <input type="radio" name="is_rules_pdf" id="is_rules_pdf" value="1" {{ ($tournament->is_rules_pdf == 1) ? 'checked' : '' }}>
                                    PDF
                                </label>
                                <label>
                                    <input type="radio" name="is_rules_pdf" id="is_rules_pdf" value="2" {{ ($tournament->is_rules_pdf == 2) ? 'checked' : '' }}>
                                    Aucun
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- text input -->
                    <div class="form-group">
                        <label for="rules_url">Adresse web</label>
                        <input type="url" id="rules_url" name="rules_url" class="form-control" placeholder="Veuillez entrer l'URL" value="{{ $tournament->rules_url or '' }}" {{ ($tournament->is_rules_pdf) ? 'disabled' : '' }}>
                    </div>

                    <div class="form-group">
                        <label for="rules_pdf">Fichier PDF</label>
                        <input type="file" id="rules_pdf" name="rules_pdf" accept="application/pdf" {{ ($tournament->is_rules_pdf) ? '' : 'disabled' }}>
                    </div>

                    <!-- radio -->
                    <div class="form-group">
                        <label for="formation">Formation ?</label>
                        <div class="radio radiobutton">
                            <label>
                                <input type="radio" name="formation" value="0" {{ ($tournament->formation == 0) ? 'checked' : '' }}>
                                Individuel
                            </label>
                            <label class="margin-right-15">
                                <input type="radio" name="formation" value="1" {{ ($tournament->formation == 1) ? 'checked' : '' }}>
                                Équipe
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="add-players" class="btn btn-default {{ ($tournament->formation == 0) ? '' : 'disabled' }}" name="submitbutton" value="saveManagePlayers" {{ ($tournament->formation == 0) ? '' : 'disabled' }}>Gérer les participants</button>
                        <button type="submit" id="add-teams" class="btn btn-default {{ ($tournament->formation == 1) ? '' : 'disabled' }}" name="submitbutton" value="saveAddTeams" {{ ($tournament->formation == 1) ? '' : 'disabled' }}>Ajouter une équipe</button>
                    </div>

                    <div id="teams" {!! ($tournament->formation == 1) ? '' : 'style="display: none;"'!!}>
                        <table class="table table-bordered table-hover sortingTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nom de l'équipe</th>
                                    <th>Joueurs</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($teams as $team)
                                    <tr>
                                        <td class="addNewScore"><a href="{{ route('admin.teams.edit', [$tournament->id, $team->id]) }}"><i class="fa fa-edit"></i></a></td>
                                        <td>{{ $team->name }}</td>
                                        <td>
                                            @foreach ($team->members as $member)
                                                {{$member->first_name}} {{$member->last_name}} <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Nom de l'équipe</th>
                                    <th>Joueurs</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div id="solo" {!! ($tournament->formation == 0) ? '' : 'style="display: none;"' !!}>
                        <table class="table table-bordered table-hover sortingTable">
                            <thead>
                                <tr>
                                    <th>Joueurs</th>
                                    <th>Classement</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($tournament->members as $member)
                                    <tr>
                                        <td> {{ $member->first_name }} {{ $member->last_name }}</td>
                                        <td>{{ $member->pivot->rank }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Joueurs</th>
                                    <th>Classement</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="is_finished" name="is_finished" {{ ($tournament->is_finished) ? 'checked' : '' }}> Terminé ?
                        </label>
                    </div>

                    <!-- radio -->
                    <div class="form-group">
                        <label for="is_ranking">Podium ?</label>
                        <div class="radio radiobutton">
                            <label>
                                <input type="radio" name="is_ranking" value="0" {{ (!isset($tournament->podium) || (isset($tournament->podium) && $tournament->podium->is_ranking == 0)) ? 'checked' : '' }}>
                                Non
                            </label>
                            <label class="margin-right-15">
                                <input type="radio" name="is_ranking" value="1" {{ (isset($tournament->podium) && $tournament->podium->is_ranking == 1) ? 'checked' : '' }}>
                                Oui
                            </label>
                        </div>
                    </div>

                    <div class="finished" {!! ($tournament->is_finished) ? 'style="display: block;"' : 'style="display: none;"' !!}>
                        <div class="form-group after_end">
                            <label for="lexer_url">Résultats sous Lexer</label>
                            <input type="url" name="lexer_url" class="form-control" value="{{ $tournament->lexer_url }}" placeholder="Veuillez entrer l'URL">
                        </div>

                        <div class="form-group after_end">
                            <label for="listing">Résultats sous forme de listing</label>
                            <input type="file" name="listing" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="report">Compte rendu</label>
                            <textarea class="ckeditor form-control" name="report" rows="20" placeholder="Entrer votre compte rendu...">{{ $tournament->report or '' }}</textarea>
                        </div>
                    </div>

                    @include('partials._form-error')

                    <div class="box-footer col-xs-8">
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Mettre-à-jour</button>
                    </div>
                </form>
                <div class="box-footer col-xs-4 pull-right">
                    <form method="POST" action="/administration/tournois/{{ $tournament->id }}" role="form">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger pull-right margin-right-10">Détruire</button>
                        <a href="{{ route('admin.tournois.index') }}" class="btn btn-default pull-right margin-right-10">Retour à l'index des tournois</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
    <script src="{{ asset('js/adminformation.js') }}"></script>
@endsection