@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des clubs du site internet </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Contenu général</li>
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
                <h3 class="box-title">Modification des contenus</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">

                {{$contentInformation["appel partenaires"]->description}}

                <form method="POST" action="/administration/contentInformation" enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <!-- textarea -->
                    <div class="form-group">
                        <label for="presentation">Présentation :</label>
                        <textarea name="presentation" class="ckeditor form-control" rows="3" placeholder="Veuillez entrer la description de la présentation">{{ isset($contentInformation["presentation"]->description) ? $contentInformation["presentation"]->description : '' }}</textarea>
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label for="adresses">Adresses :</label>
                        <textarea name="adresses" class="ckeditor form-control" rows="3" placeholder="Veuillez entrer les adresses">{{ isset($contentInformation["adresses"]->description) ? $contentInformation["adresses"]->description : '' }}</textarea>
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label for="version">Version :</label>
                        <textarea name="version" class="ckeditor form-control" rows="3" placeholder="Veuillez entrer la description de la partie version" >{{ isset($contentInformation["version"]->description) ? $contentInformation["version"]->description : '' }}</textarea>
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label for="mentions_legales">Mentions légales :</label>
                        <textarea name="mentions_legales" class="ckeditor form-control" rows="3" placeholder="Veuillez entrer la description des mentions légales">{{ isset($contentInformation["mentions légales"]->description) ? $contentInformation["mentions légales"]->description : '' }}</textarea>
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label for="appel_partenaires">Appel partenaire :</label>
                        <textarea name="appel_partenaires" class="ckeditor form-control" rows="3" placeholder="Veuillez entrer la description aux appels aux partenaires">{{ isset($contentInformation["appel partenaires"]->description) ? $contentInformation["appel partenaires"]->description : '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="logo">Logo du club</label>
                        <input type="file" id="logo" name="logo" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="banner">Image de la bannière</label>
                        <input type="file" id="banner" name="banner" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="office">Image du bureau</label>
                        <input type="file" id="office" name="office" accept="image/*">
                    </div>
                    
                    <div class="form-group">
                        <label for="music">Musique</label>
                        <input type="file" id="music" name="music" accept="audio/*">
                    </div>

                    <div class="form-group">
                        <label for="music">Volume de la musique</label> <span id="volume__value">{{ isset($contentInformation["volume musique"]->description) ? number_format(floatval($contentInformation["volume musique"]->description) * 100, 0) : '0' }} %</span>
                        <input type="range" id="volume" name="volume"  min="0" max="1" step="0.01" value="{{ isset($contentInformation["volume musique"]->description) ? $contentInformation["volume musique"]->description : '0' }}">
                    </div>

                    <div class="form-group">
                        <label for="fb_image">Facebook image</label>
                        <input type="file" id="fb_image" name="fb_image" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="fb_url">Facebook url</label>
                        <input type="text" id="fb_url" name="fb_url" class="form-control" placeholder="Veuillez entrer le nom" value="{{ isset($contentInformation["facebook url"]->description) ? $contentInformation["facebook url"]->description : '' }}">
                    </div>

                    @include('partials._form-error')

                    <div class="box-footer col-xs-6">
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Mettre-à-jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
    <script>
        let inputVolume = document.querySelector('#volume');
        let displayVolume = document.querySelector('#volume__value');

        inputVolume.addEventListener('change', event => {
            let volume = event.target.value;
            displayVolume.innerHTML = Math.round(volume * 100) + "%";
        });
    </script>
@endsection