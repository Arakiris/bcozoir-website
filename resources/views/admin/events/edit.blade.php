@extends('layouts.admin') 

@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des évènements du club </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Evenements</li>
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
                <h3 class="box-title">&Eacute;diter un évènement</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/admin/evenements/{{ $event->id }}" enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <!-- text input -->
                    <div class="form-group">
                        <label for="name">Intitulé de l'évènement</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Veuillez entrer l'intitulé de l'évènement" value="{{ $event->name }}" required>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="place">Lieu de l'évènement</label>
                        <input type="text" id="place" name="place" class="form-control" placeholder="Veuillez entrer le lieu de l'évènement" value="{{ $event->place }}" required>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="date">Date de l'évènement</label>
                        <input type="date" id="date" name="date" class="form-control" min="01-01-2000" value="{{ date('Y-m-d', strtotime($event->date)) }}" required>
                    </div>

                    @include('partials._form-error')

                    <div class="box-footer col-xs-6">
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Mettre-à-jour</button>
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save-add">MAJ et ajouter des photos</button>
                    </div>
                </form>
                <div class="box-footer col-xs-6 pull-right">
                    <form method="POST" action="/admin/evenements/{{ $event->id }}" role="form">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger pull-right margin-right-10">Détruire</button>
                        <a href="{{ route('admin.evenements.index') }}" class="btn btn-default pull-right margin-right-10">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection