@extends('layouts.admin')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des photos du site internet </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Photos</li>
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
                <h3 class="box-title">Ajouter des photos</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="{{ route('admin.photos.store', ['type' => $type, 'idtype' => $data->id, 'title' => $title]) }}" role="form" class="dropzone" id="myAwesomeDropzone" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <!-- text input -->
                    <input type="hidden" id="type" name="type" class="form-control" value="{{ $type }}" required>
                    <input type="hidden" id="type" name="type" class="form-control" value="{{ $data->id }}" required>
                    <input type="hidden" id="type" name="type" class="form-control" value="{{ $title }}" required>

                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>
                </form>
                <div class="box-footer">
                    <div class="pull-right">
                        <a href="{{ route($cancel) }}" class="btn btn-default">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection