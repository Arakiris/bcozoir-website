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
        <li class="active">Cr&eacute;ation</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- left column -->
    <div class="col-xs-12">

        <!-- general form elements disabled -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Cr&eacute;er un nouveau tournoi</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/administration/tournois" enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}

                    <!-- select -->
                    <div class="form-group">
                        <label>Type de Tournois</label>
                        <select class="form-control" id="type_id" name="type_id" required>
                            @foreach($tournamentTypes as $type)
                                <option value="{{ $type->id }}"> {{ $type->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- text input -->
                    <div class="form-group">
                        <label for="start_season">Année de début de saison</label>
                        <input type="number" id="start_season" name="start_season" class="form-control" min="2000" required>
                    </div>

                    <!-- text input -->
                    <div class="form-group">
                        <label for="title">Intitulé du tournoi</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Veuillez entrer l'intitulé du tournoi" required>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="place">Lieu du tournoi</label>
                        <input type="text" id="place" name="place" class="form-control" placeholder="Veuillez entrer le lieu du tournoi" required>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="date">Date du tournoi</label>
                        <input type="date" id="date" name="date" class="form-control" min="01-01-2000" required>
                    </div>

                    <div class="col-md-6">
                        <!-- radio -->
                        <div class="form-group">
                            <label for="is_accredited">Homologué ?</label>
                            <div class="radio radiobutton">
                                <label class="margin-right-15">
                                    <input type="radio" name="is_accredited" id="is_accredited" value="1" checked>
                                    Oui
                                </label>
                                <label>
                                    <input type="radio" name="is_accredited" id="is_accredited" value="0">
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
                                    <input type="radio" name="is_rules_pdf" id="is_rules_pdf" value="0" checked>
                                    URL
                                </label>
                                <label>
                                    <input type="radio" name="is_rules_pdf" id="is_rules_pdf" value="1">
                                    PDF
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- text input -->
                    <div class="form-group">
                        <label for="rules_url">Adresse web</label>
                        <input type="url" id="rules_url" name="rules_url" class="form-control" placeholder="Veuillez entrer l'URL">
                    </div>

                    <!-- radio -->
                    <div class="form-group">
                        <label for="formation">Formation ?</label>
                        <div class="radio radiobutton">
                            <label>
                                <input type="radio" name="formation"  value="0" checked>
                                Individuel
                            </label>
                            <label class="margin-right-15">
                                <input type="radio" name="formation"  value="1">
                                Équipe
                            </label>
                        </div>
                    </div>
                    
                    <div id="teams" style="display: none;">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nom de l'équipe</th>
                                    <th>Joueurs</th>
                                </tr>
                            </thead>

                            <tbody>

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

                    <div id="solo">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Joueurs</th>
                                    <th>Classement</th>
                                    <th>Ordre d'affichage</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Joueurs</th>
                                    <th>Classement</th>
                                    <th>Ordre d'affichage</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="form-group">
                        <label for="rules_pdf">Fichier PDF</label>
                        <input type="file" id="rules_pdf" name="rules_pdf" accept="application/pdf" disabled>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="is_finished" name="is_finished"> Terminé ?
                        </label>
                    </div>

                    <div class="finished">
                        <div class="form-group after_end">
                            <label for="lexer_url">Résultats sous Lexer</label>
                            <input type="url" name="lexer_url" class="form-control" placeholder="Veuillez entrer l'URL">
                        </div>

                        <div class="form-group after_end">
                            <label for="listing">Résultats sous forme de listing</label>
                            <input type="file" name="listing" accept="image/*">
                        </div>

                        <div class="form-group after_end">
                            <label for="report">Compte rendu</label>
                            <textarea class="form-control" id="editor" name="report" rows="20" placeholder="Entrer votre compte rendu...">{{ $tournament->report or '' }}</textarea>
                        </div>
                    </div>

                    @include('partials._form-error')

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Enregistrer</button>
                        <button type="submit" id="add-teams" class="btn btn-default disabled" name="submitbutton" value="saveAddTeams" disabled>Enregistrer et ajouter une équipe</button>
                        <button type="submit" id="add-players" class="btn btn-default" name="submitbutton" value="saveManagePlayers"}>Enregistrer et ajouter des participants</button>
                        
                        <div class="pull-right">
                            <a href="{{ route('admin.tournois.index') }}" class="btn btn-default">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
    <script src="{{ asset('js/adminformation.js') }}"></script>
@endsection