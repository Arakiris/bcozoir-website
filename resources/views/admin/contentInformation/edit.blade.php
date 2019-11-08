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
                <form method="POST" action="/administration/contentInformation" enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <!-- textarea -->
                    <div class="form-group">
                        <label for="presentation">Présentation :</label>
                        <textarea name="presentation" class="ckeditor form-control" rows="3" placeholder="Veuillez entrer la description de la présentation">{{ isset($contentInformation->get(0)->description) ? $contentInformation->get(0)->description : '' }}</textarea>
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label for="adresses">Adresses :</label>
                        <textarea name="adresses" class="ckeditor form-control" rows="3" placeholder="Veuillez entrer les adresses">{{ isset($contentInformation->get(1)->description) ? $contentInformation->get(1)->description : '' }}</textarea>
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label for="version">Version :</label>
                        <textarea name="version" class="ckeditor form-control" rows="3" placeholder="Veuillez entrer la description de la partie version" >{{ isset($contentInformation->get(2)->description) ? $contentInformation->get(2)->description : '' }}</textarea>
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label for="mentions_legales">Mentions légales :</label>
                        <textarea name="mentions_legales" class="ckeditor form-control" rows="3" placeholder="Veuillez entrer la description des mentions légales">{{ isset($contentInformation->get(3)->description) ? $contentInformation->get(3)->description : '' }}</textarea>
                    </div>

                    <!-- textarea -->
                    <div class="form-group">
                        <label for="appel_partenaires">Appel partenaire :</label>
                        <textarea name="appel_partenaires" class="ckeditor form-control" rows="3" placeholder="Veuillez entrer la description aux appels aux partenaires">{{ isset($contentInformation->get(4)->description) ? $contentInformation->get(4)->description : '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="office">Image du bureau</label>
                        <input type="file" id="office" name="office" accept="image/*">
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