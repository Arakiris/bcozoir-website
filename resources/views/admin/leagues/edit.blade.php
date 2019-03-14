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
                <form method="POST" action="/administration/ligues/{{ $league->id }}" enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <!-- text input -->
                    <div class="form-group">
                        <label for="name">Intitulé de la ligue</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Veuillez entrer l'intitulé de la ligue" value="{{ $league->name }}" required>
                    </div>

                    <!-- text input -->
                    <div class="form-group">
                        <label for="start_season">Année de début de saison</label>
                        <input type="number" id="start_season" name="start_season" class="form-control" min="2000" value="{{ date('Y', strtotime($league->start_season)) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Jour de la semaine</label>
                        <select class="form-control" id="day_of_week" name="day_of_week" required>
                            <option value="Lundi" {{ ($league->day_of_week === "Lundi") ? "selected" : ""}}>Lundi</option>
                            <option value="Mardi" {{ ($league->day_of_week === "Mardi") ? "selected" : ""}}>Mardi</option>
                            <option value="Mercredi" {{ ($league->day_of_week === "Mercredi") ? "selected" : ""}}>Mercredi</option>
                            <option value="Jeudi" {{ ($league->day_of_week === "Jeudi") ? "selected" : ""}}>Jeudi</option>
                            <option value="Vendredi" {{ ($league->day_of_week === "Vendredi") ? "selected" : ""}}>Vendredi</option>
                            <option value="Samedi" {{ ($league->day_of_week === "Samedi") ? "selected" : ""}}>Samedi</option>
                            <option value="Dimanche" {{ ($league->day_of_week === "Dimanche") ? "selected" : ""}}>Dimanche</option>
                        </select>
                    </div>

                    <div class="col-xs-12">
                        <!-- radio -->
                        <div class="form-group">
                            <label for="is_accredited">Homologué ?</label>
                            <div class="radio radiobutton">
                                <label class="margin-right-15">
                                    <input type="radio" name="is_accredited" id="is_accredited" value="1"  {{ ($league->is_accredited == 1) ? "checked" : ""}}>
                                    Oui
                                </label>
                                <label>
                                    <input type="radio" name="is_accredited" id="is_accredited" value="0" {{ ($league->is_accredited == 0) ? "checked" : ""}}>
                                    Non
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="place">Lieu</label>
                        <input type="text" id="place" name="place" class="form-control" placeholder="Veuillez entrer le lieu" value="{{ $league->place }}" required>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="place">Nom de l'équipe</label>
                        <input type="text" id="team_name" name="team_name" class="form-control" placeholder="Veuillez entrer le nom de l'équipe" value="{{ $league->team_name }}" required>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="place">Résultats</label>
                        <input type="url" id="result" name="result" class="form-control" placeholder="Veuillez entrer l'URL des résultats" value="{{ $league->result }}">
                    </div>

                    @include('partials._form-error')

                    <div class="box-footer col-xs-8">
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Mettre-à-jour</button>
                    </div>
                </form>
                <div class="box-footer col-xs-4 pull-right">
                    <form method="POST" action="/administration/ligues/{{ $league->id }}" role="form">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger pull-right margin-right-10">Détruire</button>
                        <a href="{{ route('admin.ligues.index') }}" class="btn btn-default pull-right margin-right-10">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection