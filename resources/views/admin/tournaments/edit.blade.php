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
                <form method="POST" action="/admin/tournois/{{ $tournament->id }}" enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="abc"></div>

                    <!-- select -->
                    <div class="form-group">
                        <label>Type de Tournois</label>
                        <select class="form-control" id="type_id" name="type_id" required>
                            @foreach($tournamentTypes as $type)
                                <option value="{{ $type->id }}" {{ ($type->id == $tournament->type_id) ? 'checked' : '' }}> {{ $type->title }}</option>
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
                        <input type="date" id="date" name="date" class="form-control" min="01-01-2000" value="{{ date('Y-m-d', strtotime($tournament->date)) }}" required>
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
                                    <input type="radio" name="is_rules_pdf" id="is_rules_pdf" value="0" {{ ($tournament->is_rules_pdf) ? '' : 'checked' }}>
                                    URL
                                </label>
                                <label>
                                    <input type="radio" name="is_rules_pdf" id="is_rules_pdf" value="1" {{ ($tournament->is_rules_pdf) ? 'checked' : '' }}>
                                    PDF
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

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="is_finished" name="is_finished" {{ ($tournament->is_finished) ? 'checked' : '' }}> Terminé ?
                        </label>
                    </div>

                    <div class="finished" {!! ($tournament->is_finished) ? 'style="display: block;"' : 'style="display: none;"' !!}>
                        <div class="form-group">
                            <label for="listing">Listing</label>
                            <input type="file" id="listing" name="listing" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="report">Compte rendu</label>
                            <textarea class="form-control" id="report" name="report" rows="3" placeholder="Entrer votre compte rendu...">{{ $tournament->report or '' }}</textarea>
                        </div>
                    </div>

                    @include('partials._form-error')

                    <div class="box-footer col-xs-8">
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Mettre-à-jour</button>
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save-add">MAJ et ajouter des photos</button>
                    </div>
                </form>
                <div class="box-footer col-xs-4 pull-right">
                    <form method="POST" action="/admin/tournois/{{ $tournament->id }}" role="form">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger pull-right margin-right-10">Détruire</button>
                        <a href="{{ route('admin.tournois.index') }}" class="btn btn-default pull-right margin-right-10">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection