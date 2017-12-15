@extends('layouts.admin')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des liens utiles</h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Liens</li>
        <li class="active">&Eacute;dition</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-xs-12">

            <!-- general form elements disabled -->
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">&Eacute;diter un lien utile</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <form method="POST" action="/administration/liens/{{ $link->id }}"  enctype="multipart/form-data" role="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <img src="{{ ($link->picture->first()) ? asset('storage/' . $link->picture->first()->path) : null }}" alt="Image du lien utile" class="adminEditImg">
                        </div>

                        <div class="form-group">
                            <label for="image">Changer d'image</label>
                            <input type="file" id="image" name="image" accept="image/*">
                        </div>

                        <!-- text input -->
                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Veuillez entrer le titre du lien utile" value="{{ $link->title }}" required>
                        </div>

                        <div class="form-group">
                            <label for="link">Adresse Internet</label>
                            <input type="text" id="link" name="link" class="form-control" placeholder="Veuillez entrer l'url du lien utile" value="{{ $link->link }}" required>
                        </div>


                        @include('partials._form-error')

                        <div class="box-footer col-xs-6">
                            <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Mettre-à-jour</button>
                        </div>
                    </form>
                    <div class="box-footer col-xs-6 pull-right">
                        <form method="POST" action="/administration/liens/{{ $link->id }}" role="form">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger pull-right margin-right-10">Détruire</button>
                            <a href="{{ route('admin.liens.index') }}" class="btn btn-default pull-right margin-right-10">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->
@endsection