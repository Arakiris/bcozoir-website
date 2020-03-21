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
                            <label for="title">Nom</label>
                            <textarea type="text" id="title" name="title" row="3" class="ckeditor form-control" placeholder="Veuillez entrer le nom du partenaire" required>{{ old('title', isset($partner->title) ? $partner->title   : '') }}</textarea>
                        </div>

                        <!-- text input -->
                        <div class="form-group">
                            <label for="address">Adresse</label>
                            <textarea type="text" id="address" name="address" row="3" class="ckeditor form-control" placeholder="Veuillez entrer l'adresse du partenaire">{{ old('address', isset($partner->address) ? $partner->address   : '') }}</textarea>
                        </div>

                        <!-- text input -->
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" id="website" name="website" class="form-control" placeholder="Veuillez entrer le site" value="{{ old('website', isset($partner->website) ? $partner->website  : '') }}">
                        </div>

                        <!-- text input -->
                        <div class="form-group">
                            <label for="url">Url</label>
                            <input type="text" id="url" name="url" class="form-control" placeholder="Veuillez entrer le site" value="{{ old('url', isset($partner->url) ? $partner->url  : '') }}">
                        </div>

                        <!-- text input -->
                        <div class="form-group">
                            <label for="mail">Mail</label>
                            <input type="text" id="mail" name="mail" class="form-control" placeholder="Veuillez entrer l'adresse mail du partenaire" value="{{ old('mail', isset($partner->mail) ? $partner->mail  : '') }}">
                        </div>

                        <!-- text input -->
                        <div class="form-group">
                            <label for="phone1">Téléphone 1</label>
                            <input type="tel" id="phone1" name="phone1" class="form-control" placeholder="Veuillez entrer le téléphone du partenaire" value="{{ old('phone1', isset($partner->phone1) ? $partner->phone1  : '') }}">
                        </div>

                        <!-- text input -->
                        <div class="form-group">
                            <label for="phone2">Téléphone 2</label>
                            <input type="tel" id="phone2" name="phone2" class="form-control" placeholder="Veuillez entrer le téléphone du partenaire" value="{{ old('phone2', isset($partner->phone2) ? $partner->phone2  : '') }}">
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