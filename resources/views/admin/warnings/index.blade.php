@extends('layouts.admin')
@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des clubs du site internet </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> News</li>
        <li class="active">Toutes les news</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Donn&eacute;es concernant les alertes</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover sortingTable2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Titre</th>
                                <th>Date de disparition</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if($warnings)
                            @foreach($warnings as $warning)
                                <tr>
                                    <td class="addNewScore"><a href="{{ route('admin.alertes.edit', $warning->id) }}"><i class="fa fa-edit"></i></a></td>
                                    <td>{{ $warning->id }}</td>
                                    <td>{{ $warning->body }}</td>
                                    <td>{{ $warning->date_disappear->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Titre</th>
                                <th>Date de disparition</th>
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