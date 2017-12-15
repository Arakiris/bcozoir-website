@extends('layouts.admin')
@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des annonces</h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Annonces</li>
        <li class="active">Index</li>
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
                    <h3 class="box-title">Cr&eacute;er une nouvelle vidéo</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <form method="POST" action="/administration/videos/{{ $type }}/{{ $data->id }}" enctype="multipart/form-data" role="form">
                        {{ csrf_field() }}

                        <input type="hidden" id="type" name="type" class="form-control" value="{{ $type }}" required>
                        <input type="hidden" id="type" name="type" class="form-control" value="{{ $data->id }}" required>

                        <div class="form-group">
                            <label for="path_mp4">Vidéo format MP4</label>
                            <input type="file" id="path_mp4" name="path_mp4" accept="video/mp4">
                        </div>

                        <div class="form-group">
                            <label for="path_webm">Vidéo format WebM</label>
                            <input type="file" id="path_webm" name="path_webm" accept="video/webm">
                        </div>

                        @include('partials._form-error')

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <div class="pull-right">
                                <a href="{{ route($cancel) }}" class="btn btn-default">Annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->
@endsection