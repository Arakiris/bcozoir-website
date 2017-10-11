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
        <li><i class="fa fa-dashboard"></i> Membre</li>
        <li class="active">Score</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tous les scores de {{ $member->first_name }} {{ $member->last_name }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover sortingTable2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Moyenne</th>
                                <th>Mois</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if($member->scores)
                            @foreach($member->scores as $score)
                            <tr>
                                <td class="addNewScore"><a href="{{ route('admin.scores.edit', [$score->member->id, $score->id]) }}"><i class="fa fa-edit"></i></a></td>
                                <td>{{ $score->average }}</td>
                                <td>{{ date('Y-m', strtotime($score->month)) }}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
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