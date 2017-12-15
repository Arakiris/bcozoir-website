@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des clubs du site internet </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>Club</li>
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
                <h3 class="box-title">&Eacute;diter un club</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/administration/clubs/{{ $club->id }}" role="form">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <!-- text input -->
                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Veuillez entrer le nom du club" value="{{ $club->name }}" required>
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label for="address">Adresse</label>
                        <textarea id="address" name="address" class="form-control" rows="3" placeholder="Veuillez entrer l'adresse du club">{{ $club->address }}</textarea>
                    </div>

                    @include('partials._form-error')

                    <div class="box-footer col-xs-6">
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Mettre-à-jour</button>
                    </div>
                </form>
                <div class="box-footer col-xs-6 pull-right">
                    <form method="POST" action="/administration/clubs/{{ $club->id }}" role="form">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger pull-right margin-right-10">Détruire</button>
                        <a href="{{ route('admin.clubs.index') }}" class="btn btn-default pull-right margin-right-10">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection