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
                <h3 class="box-title">Modification  d'une alerte</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/administration/alertes/{{ $warning->id }}" role="form">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <!-- textarea -->
                    <div class="form-group">
                        <label for="body">Contenu de l'alerte</label>
                        <textarea id="editor" name="body" class="form-control" rows="3" placeholder="Veuillez entrer le contenu de l'actualité">{{ $warning->body }}</textarea>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="date_begin">&Agrave; partir de quelle date doit être afficher ?</label>
                        <input type="date" id="date_begin" name="date_begin" class="form-control" value="{{ isset($warning->date_begin) ? date('Y-m-d', strtotime($warning->date_begin)) : '' }}">
                    </div>
                    

                    <!-- date input -->
                    <div class="form-group">
                        <label for="date_disappear">&Agrave; partir de quelle date ne plus afficher le message ?</label>
                        <input type="date" id="date_disappear" name="date_disappear" class="form-control" value="{{ date('Y-m-d', strtotime($warning->date_disappear)) }}" required>
                    </div>

                    @include('partials._form-error')

                        <div class="box-footer col-xs-6">
                            <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Mettre-à-jour</button>
                        </div>
                    </form>
                    <div class="box-footer col-xs-6 pull-right">
                        <form method="POST" action="/administration/alertes/{{ $warning->id }}" role="form">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger pull-right margin-right-10">Détruire</button>
                            <a href="{{ route('admin.alertes.index') }}" class="btn btn-default pull-right margin-right-10">Annuler</a>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection