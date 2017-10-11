@extends('layouts.admin') 

@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des évènements du clubs </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Evenements</li>
        <li class="active">Index</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Données concernant les évènements du club</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover sortingTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Lieu</th>
                                <th>Date</th>
                                <th>Gestion des photos</th>
                                <th>Gestion des vidéos</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td class="addNewScore"><a href="{{ route('admin.evenements.edit', $event->id) }}"><i class="fa fa-edit"></i></a></td>
                                    <td>{{ $event->id }}</td>
                                    <td>{{ $event->name }}</td>
                                    <td>{{ $event->place }}</td>
                                    <td>{{ date('d-m-Y', strtotime($event->date)) }}</td>
                                    <td class="addNewScore">
                                        <a href="{{ route('admin.photos.create', ['evenement', $event->id]) }}" class="adminMemberPicture__links">
                                            <i class="fa fa-plus-square"></i>
                                        </a>
                                        <a href="{{ route('admin.photos.index', ['evenement', $event->id]) }}" class="adminMemberPicture__links">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                    </td>
                                    <td class="addNewScore">
                                        <a href="{{ route('admin.videos.create', ['evenement', $event->id]) }}" class="adminMemberPicture__links">
                                            <i class="fa fa-plus-square"></i>
                                        </a>
                                        <a href="{{ route('admin.videos.index', ['evenement', $event->id]) }}" class="adminMemberPicture__links">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Lieu</th>
                                <th>Date</th>
                                <th>Gestion des photos</th>
                                <th>Gestion des vidéos</th>
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