@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des informations du site internet </h1>

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
                <h2 class="box-title">Modification des contenus</h2>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
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
                        <label for="tournament_image_1">Libellé 1 liste tounois</label>
                        <input type="file" id="tournament_image_1" name="tournament_image_1" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="tournament_image_2">Libellé 2 liste tounois</label>
                        <input type="file" id="tournament_image_2" name="tournament_image_2" accept="image/*">
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

                    <div class="form-group">
                        <label for="map_title">Titre de la carte</label>
                        <input type="text" name="map_title" class="form-control" placeholder="Veuillez entrer le nom" value="{{ isset($contentInformation["map"]) ? (isset($contentInformation["map"]->path) ? $contentInformation["map"]->path : '') : '' }}">
                    </div>

                    <div class="form-group margin-bottom-40">
                        <label for="map_link">Url de la carte</label>
                        <input type="text" name="map_link" class="form-control" placeholder="Veuillez entrer le nom" value="{{ isset($contentInformation["map"]) ? (isset($contentInformation["map"]->description) ? $contentInformation["map"]->description : '') : '' }}">
                    </div>

                    @for ($i = 1; $i < 19; $i++)
                        @php
                            $j = $i - 1;
                        @endphp
                        <div class="box box-primary box-social-media">
                            <div class="box-header">
                                <h3 class="box-title">Lien social media {{ $i }}</h3>
                            </div>

                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="socialMedia[{{ $i }}][image]">Image</label>
                                            <input type="file" name="socialMedia[{{ $i }}][image]" accept="image/*">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="socialMedia[{{ $i }}][display]">Afficher ?</label>
                                            <div class="radio radiobutton">
                                                <label class="margin-right-15">
                                                    <input type="radio" name="socialMedia[{{ $i }}][display]" value="0" {{ isset($socialMedia[$j]) ? (($socialMedia[$j]->display == 0) ? 'checked' : '') : 'checked' }}>
                                                    Non
                                                </label>
                                                <label>
                                                    <input type="radio" name="socialMedia[{{ $i }}][display]" value="1" {{ isset($socialMedia[$j]) ? (($socialMedia[$j]->display == 1) ? 'checked' : '') : '' }}>
                                                    Oui
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="form-group">
                                    <label for="socialMedia[{{ $i }}][url]">Url</label>
                                    <input type="text" name="socialMedia[{{ $i }}][url]" class="form-control" placeholder="Veuillez entrer l'url" value="{{ isset($socialMedia[$j]) ? $socialMedia[$j]->url : '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="socialMedia[{{ $i }}][description]">Description</label>
                                    <input type="text" name="socialMedia[{{ $i }}][description]" class="form-control" placeholder="Veuillez entrer la description" value="{{ isset($socialMedia[$j]) ? $socialMedia[$j]->description : '' }}">
                                </div>
                            </div>
                        </div>
                        
                    @endfor

                    <!-- textarea -->
                    <div class="form-group">
                        <label for="courrier_postal">Courrier postal :</label>
                        <textarea name="courrier_postal" class="ckeditor form-control" rows="3" placeholder="Veuillez entrer le courrier postal">{{ isset($contentInformation["courrier_postal"]->description) ? $contentInformation["courrier_postal"]->description : '' }}</textarea>
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