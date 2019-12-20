@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des clubs du site internet </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Alertes</li>
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
                <h3 class="box-title">Cr&eacute;er une nouvelle alerte</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/administration/alertes" role="form">
                    {{ csrf_field() }}

                    <!-- textarea -->
                    <div class="form-group">
                        <label for="body">Contenu de l'alerte</label>
                        <textarea name="body" class="ckeditor form-control" rows="3" placeholder="Veuillez entrer le contenu de l'actualité"></textarea>
                    </div>
                    
                    <!-- date input -->
                    <div class="form-group">
                        <label for="date_begin">&Agrave; partir de quelle date doit-il être affiché ?</label>
                        <input type="date" id="date_begin" name="date_begin" class="form-control">
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="date_disappear">&Agrave; partir de quelle date ne plus afficher le message ?</label>
                        <input type="date" id="date_disappear" name="date_disappear" class="form-control" required>
                    </div>

                    @include('partials._form-error')

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Enregistrer</button>
                        
                        <div class="pull-right">
                            <a href="{{ route('admin.alertes.index') }}" class="btn btn-default">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')

@endsection