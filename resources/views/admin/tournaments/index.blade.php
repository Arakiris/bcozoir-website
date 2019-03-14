@extends('layouts.admin')
@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des tounois du club </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Tournois</li>
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
                    <h3 class="box-title">Données concernant les tournois</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover sortingTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Intitulé</th>
                                <th>Date</th>
                                <th>Homologué</th>
                                <th>Lieu</th>
                                <th>Status</th>
                                <th>Compte rendu</th>
                                <th>Photos</th>
                                <th>Vidéos</th>
                                <th>Podium</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($tournaments as $tournament)
                                <tr>
                                    <td class="addNewScore"><a href="{{ route('admin.tournois.edit', $tournament->id) }}"><i class="fa fa-edit"></i></a></td>
                                    <td>{{ $tournament->id }}</td>
                                    <td>{{ $tournament->type->title }}</td>
                                    <td>{{ $tournament->title }}</td>
                                    <td>{{ $tournament->date->format('Y-m-d') }}</td>
                                    <td>{{ ($tournament->is_accredited) ? 'Homologué' : 'Non homologué' }}</td>
                                    <td>{{ $tournament->place }}</td>
                                    <td>{{ ($tournament->is_finished) ? 'Terminé' : 'Á venir' }}</td>
                                    <td>{{ ($tournament->report) ? str_limit($tournament->report, 20, '&raquo') : 'Pas de compte rendu' }}</td>
                                    <td class="addNewScore">
                                        <?php setlocale(LC_TIME, 'fr'); $datetournament = utf8_encode(strftime("%d %B %Y", strtotime($tournament->date->format('Y-m-d')))); ?>
                                        <a href="{{ route('admin.photos.create', ['tournoi', $tournament->id, '61p61' . $datetournament . '85br85' . $tournament->place .'61pbis61']) }}" class="adminMemberPicture__links">
                                            <i class="fa fa-plus-square"></i>
                                        </a>
                                        <a href="{{ route('admin.photos.index', ['tournoi', $tournament->id]) }}" class="adminMemberPicture__links">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                    </td>
                                    <td class="addNewScore">
                                        <a href="{{ route('admin.videos.create', ['tournoi', $tournament->id]) }}" class="adminMemberPicture__links">
                                            <i class="fa fa-plus-square"></i>
                                        </a>
                                        <a href="{{ route('admin.videos.index', ['tournoi', $tournament->id]) }}" class="adminMemberPicture__links">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                    </td>
                                    <td class="addNewScore">
                                        @if($tournament->is_finished == 1)
                                            <a href="{{ route('admin.photos.create', ['podium', $tournament->podium->id, '61p61' . $datetournament . '85br85' . $tournament->place .'61pbis61']) }}" class="adminMemberPicture__links">
                                                <i class="fa fa-plus-square"></i>
                                            </a>
                                            <a href="{{ route('admin.photos.index', ['podium', $tournament->podium->id]) }}" class="adminMemberPicture__links">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                        @else
                                            Ce tournoi n'est pas fini.
                                        @endisset
                                    </td>
                                    <td><a href="{{ route('admin.tournois.editPlayers', $tournament->id)}}" class="btn btn-default">Gérer les participants</a></td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Intitulé</th>
                                <th>Date</th>
                                <th>Homologué</th>
                                <th>Lieu</th>
                                <th>Status</th>
                                <th>Compte rendu</th>
                                <th>Photos</th>
                                <th>Vidéos</th>
                                <th>Podium</th>
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