@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des clubs du site internet </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> News</li>
        <li class="active">Cr&eacute;ation</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- left column -->
    <div class="col-xs-12">

        <!-- general form elements disabled -->
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Editer une nouvelle information</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/administration/actualites/{{ $news->id }}" role="form">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <!-- text input -->
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Veuillez entrer le titre" value="{{ $news->title }}" required>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" class="form-control" min="01-01-2000" value="{{ $news->date->format('Y-m-d') }}" required>
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label for="body">Contenu de l'information</label>
                        <textarea name="body" class="form-control" rows="20" placeholder="Veuillez entrer le contenu de l'information">{{ $news->body }}</textarea>
                    </div>

                    @include('partials._form-error')

                    <div class="box-footer col-xs-6">
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Mettre-à-jour</button>
                    </div>
                </form>
                <div class="box-footer col-xs-6 pull-right">
                    <form method="POST" action="/administration/actualites/{{ $news->id }}" role="form">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger pull-right margin-right-10">Détruire</button>
                        <a href="{{ route('admin.actualites.index') }}" class="btn btn-default pull-right margin-right-10">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection