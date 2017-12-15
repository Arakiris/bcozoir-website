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
                <h3 class="box-title">Cr&eacute;er une nouvelle actualit&eacute;</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/administration/actualites" role="form" id="form-Dropzone">
                    {{ csrf_field() }}
                    <!-- text input -->
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Veuillez entrer le titre" required>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" class="form-control" min="01-01-2000" required>
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label for="body">Contenu de l'actualit&eacute;</label>
                        <textarea id="editor" name="body" class="form-control" rows="3" placeholder="Veuillez entrer le contenu de l'actualité"></textarea>
                    </div>
                    
                    @include('partials._form-error')

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Enregistrer</button>
                        
                        <div class="pull-right">
                            <a href="{{ route('admin.actualites.index') }}" class="btn btn-default">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection