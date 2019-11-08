@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des scores du site internet </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>Membres</li>
        <li class="active">Scores</li>
        <li class="active">&Eacute;dition</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- left column -->
    <div class="col-xs-12">

        <!-- general form elements disabled -->
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">&eacute;diter un score</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/administration/membre/{{ $member->id }}/score/{{ $score->id }}" enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group clearfix">
                        <div class="col-sm-6">
                            <label for="last_name">Nom</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $member->last_name }}" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label for="first_name">Pr&eacute;nom</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $member->first_name }}" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group margin-top-05">
                        <label for="average">Moyenne</label>
                        <input type="text" id="average" name="average" class="form-control" placeholder="Veuillez entrer la moyenne des scores" value="{{ $score->average }}" required>
                    </div>

                    <div class="form-group">
                        <label for="month">Choix du mois</label>
                        <input type="month" id="month" name="month" class="form-control" value="{{ date('Y-m', strtotime($score->month)) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="number_lines">Nombre de lignes</label>
                        <input type="number" id="number_lines" name="number_lines" class="form-control" min="0" value="{{ $score->	number_lines }}" required>
                    </div>

                    <div class="form-group">
                        <label for="historical_path">Historique</label>
                        <input type="file" id="historical_path" name="historical_path" accept="image/*">
                    </div>

                    @include('partials._form-error')

                    <div class="box-footer col-xs-6">
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Mettre-à-jour</button>
                    </div>
                </form>
                <div class="box-footer col-xs-6 pull-right">
                    <form method="POST" action="/administration/membre/{{ $member->id }}/score/{{ $score->id }}" role="form">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger pull-right margin-right-10">Détruire</button>
                        <a href="{{ route('admin.membres.index') }}" class="btn btn-default pull-right margin-right-10">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection