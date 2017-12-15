@extends('layouts.admin')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des partenaires</h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Partenaires</li>
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
                    <h3 class="box-title">&Eacute;diter un partenaire</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <form method="POST" action="/administration/partenaires/{{ $partner->id }}"  enctype="multipart/form-data" role="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group">
                            <img src="{{ ($partner->picture->first()) ? asset('storage' . $partner->picture->first()->path) : null }}" alt="Image du lien utile" class="adminEditImg">
                        </div>

                        <div class="form-group">
                            <label for="image">Changer d'image</label>
                            <input type="file" id="image" name="image" accept="image/*">
                        </div>

                        <!-- text input -->
                        <div class="form-group">
                            <label for="address">Adresse</label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="Veuillez entrer l'adresse du partenaire" value="{{ $partner->address }}" required>
                        </div>


                        @include('partials._form-error')

                        <div class="box-footer col-xs-6">
                            <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Mettre-à-jour</button>
                        </div>
                    </form>
                    <div class="box-footer col-xs-6 pull-right">
                        <form method="POST" action="/administration/partenaires/{{ $partner->id }}" role="form">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger pull-right margin-right-10">Détruire</button>
                            <a href="{{ route('admin.partenaires.index') }}" class="btn btn-default pull-right margin-right-10">Annuler</a>
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