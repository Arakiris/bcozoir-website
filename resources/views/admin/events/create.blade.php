@extends('layouts.admin')

@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des évènements du club</h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Evenements</li>
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
                <h3 class="box-title">Cr&eacute;er un nouvel évènement</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/admin/evenements" enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}

                    <!-- text input -->
                    <div class="form-group">
                        <label for="name">Intitulé de l'évènement</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Veuillez entrer l'intitulé de l'évènement" required>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="place">Lieu de l'évènement</label>
                        <input type="text" id="place" name="place" class="form-control" placeholder="Veuillez entrer le lieu de l'évènement" required>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="date">Date de l'évènement</label>
                        <input type="date" id="date" name="date" class="form-control" min="01-01-2000" required>
                    </div>

                    @include('partials._form-error')

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Enregistrer</button>
                        <button type="submit" class="btn btn-primary after_end" name="submitbutton" value="save-add">Enregistrer et ajouter des médias</button>
                        
                        <div class="pull-right">
                            <a href="{{ route('admin.evenements.index') }}" class="btn btn-default">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection