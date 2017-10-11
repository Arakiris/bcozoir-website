@extends('layouts.admin') @section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des clubs du site internet </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Club</li>
        <li class="active">Tous les clubs</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Données concernant les clubs</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover sortingTable2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Nom du club</th>
                                <th>Adresse</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if($clubs)
                            @foreach($clubs as $club)
                            <tr>
                                <td class="addNewScore"><a href="{{ route('admin.clubs.edit', $club->id) }}"><i class="fa fa-edit"></i></a></td>
                                <td>{{ $club->id }}</td>
                                <td>{{ $club->name }}</td>
                                <td>{{ $club->address }}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Nom du club</th>
                                <th>Adresse</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
         <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->
@endsection