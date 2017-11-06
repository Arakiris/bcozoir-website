@extends('layouts.admin') @section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des ligues du site internet </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Ligues</li>
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
                <h3 class="box-title">Cr&eacute;er une nouvelle ligue</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/admin/ligues" enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}

                    <!-- text input -->
                    <div class="form-group">
                        <label for="name">Intitulé de la ligue</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Veuillez entrer l'intitulé de la ligue" required>
                    </div>

                    <!-- text input -->
                    <div class="form-group">
                        <label for="start_season">Année de début de saison</label>
                        <input type="number" id="start_season" name="start_season" class="form-control" min="2000" required>
                    </div>

                    <div class="form-group">
                        <label>Jour de la semaine</label>
                        <select class="form-control" id="day_of_week" name="day_of_week" required>
                            <option value="Lundi">Lundi</option>
                            <option value="Mardi">Mardi</option>
                            <option value="Mercredi">Mercredi</option>
                            <option value="Jeudi">Jeudi</option>
                            <option value="Vendredi">Vendredi</option>
                            <option value="Samedi">Samedi</option>
                            <option value="Dimanche">Dimanche</option>
                        </select>
                    </div>

                    <div class="col-xs-12">
                        <!-- radio -->
                        <div class="form-group">
                            <label for="is_accredited">Homologué ?</label>
                            <div class="radio radiobutton">
                                <label class="margin-right-15">
                                    <input type="radio" name="is_accredited" id="is_accredited" value="0" checked>
                                    Oui
                                </label>
                                <label>
                                    <input type="radio" name="is_accredited" id="is_accredited" value="1">
                                    Non
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="place">Lieu</label>
                        <input type="text" id="place" name="place" class="form-control" placeholder="Veuillez entrer le lieu" required>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="place">Nom de l'équipe</label>
                        <input type="text" id="team_name" name="team_name" class="form-control" placeholder="Veuillez entrer le nom de l'équipe" required>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="place">Résultats URL</label>
                        <input type="url" id="result" name="result" class="form-control" placeholder="Veuillez entrer l'URL des résultats" required>
                    </div>

                    @include('partials._form-error')

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Enregistrer</button>
                        
                        <div class="pull-right">
                            <a href="{{ route('admin.ligues.index') }}" class="btn btn-default">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection