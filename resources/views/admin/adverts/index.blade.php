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
        <div class="col-lg-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Données concernant les annonces</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover sortingTable2">
                        <thead>
                            <tr>
                                <td></td>
                                <th>Image</th>
                                <th>Date de début d'apparition</th>
                                <th>Date de fin d'apparition</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if($ads)
                            @foreach($ads as $ad)
                            <tr>
                                <td class="addNewScore"><a href="{{ route('admin.annonces.edit', $ad->id) }}"><i class="fa fa-edit"></i></a></td>
                                <td><img src="{{ ($ad->picture->first()) ? asset('storage' . $ad->picture->first()->path) : null }}" alt="Image de l'annonce" class="adminTableImg"></td>
                                <td>{{ $ad->start_display->format('Y-m-d')  }}</td>
                                <td>{{ $ad->end_display->format('Y-m-d') }}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>

                        <tfoot>
                            <tr>
                                <td></td>
                                <th>Image</th>
                                <th>Date de début d'apparition</th>
                                <th>Date de fin d'apparition</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
         <!-- /.col -->

        <div class="col-lg-6">

            <!-- general form elements disabled -->
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Cr&eacute;er une nouvelle annonce</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <form method="POST" action="/administration/annonces" enctype="multipart/form-data" role="form">
                        {{ csrf_field() }}

                        <!-- text input -->
                        <div class="form-group">
                            <label for="start_display">Date de début d'apparition de l'annonce</label>
                            <input type="date" id="start_display" name="start_display" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="end_display">Date de fin d'apparition de l'annonce</label>
                            <input type="date" id="end_display" name="end_display" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image" accept="image/*">
                        </div>

                        @include('partials._form-error')

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
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