@extends('layouts.admin')
@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des ligues du club </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Ligues</li>
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
                    <h3 class="box-title">Données concernant les ligues du club d'Ozoir</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover sortingTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Intitulé</th>
                                <th>Saison</th>
                                <th>Jour de la semaine</th>
                                <th>Status</th>
                                <th>Lieu</th>
                                <th>Nom de l'équipe</th>
                                <th>Résultats</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($leagues as $league)
                                <tr>
                                    <td class="addNewScore"><a href="{{ route('admin.ligues.edit', $league->id) }}"><i class="fa fa-edit"></i></a></td>
                                    <td>{{ $league->id }}</td>
                                    <td>{{ $league->name }}</td>
                                    <td>{{ date('Y', strtotime($league->start_season)) }} - {{ date('Y', strtotime($league->end_season)) }}</td>
                                    <td>{{ $league->day_of_week }}</td>
                                    <td>{{ ($league->is_accredited) ? 'Homologué' : 'Non homologué'  }}</td>
                                    <td>{{ $league->place }}</td>
                                    <td>{{ $league->team_name }}</td>
                                    <td>{{ $league->result }}</td>
                                    <td><a href="{{ route('admin.ligues.editPlayers', $league->id)}}" class="btn btn-default">Gérer les participants</a></td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Intitulé</th>
                                <th>Saison</th>
                                <th>Jour de la semaine</th>
                                <th>Status</th>
                                <th>Lieu</th>
                                <th>Nom de l'équipe</th>
                                <th>Résultats</th>
                                <th></th>
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