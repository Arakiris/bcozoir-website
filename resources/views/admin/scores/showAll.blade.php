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
        <li><i class="fa fa-dashboard"></i> Members</li>
        <li class="active">All scores</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tous les scores du club</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover sortingTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nom</th>
                                <th>Pr&eacute;nom</th>
                                <th>Moyenne</th>
                                <th>Mois</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if($scores)
                            @foreach($scores as $score)
                            <tr>
                                <td class="addNewScore"><a href="{{ route('admin.scores.edit', [$score->member->id, $score->id]) }}"><i class="fa fa-edit"></i></a></td>
                                <td>{{ $score->member->last_name }}</td>
                                <td>{{ $score->member->first_name  }}</td>
                                <td>{{ $score->average }}</td>
                                <td>{{ date('Y-m', strtotime($score->month)) }}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Nom</th>
                                <th>Pr&eacute;nom</th>
                                <th>Moyenne</th>
                                <th>Mois</th>
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
