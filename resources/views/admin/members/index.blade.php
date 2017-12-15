@extends('layouts.admin')
@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des membres du club </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Membres</li>
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
                    <h3 class="box-title">Données concernant les membres du club d'Ozoir</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover sortingTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nom - Prénom</th>
                                <th>Cat&eacute;gorie</th>
                                <th>Sex</th>
                                <th>Date de naissance</th>
                                <th>Status</th>
                                <th>Num&eacute;ro de licence</th>
                                <th>Handicap</th>
                                <th>Bonus</th>
                                <th>Gestion des scores</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($members as $member)
                                <tr>
                                    <td class="addNewScore"><a href="{{ route('admin.membres.edit', $member->id) }}"><i class="fa fa-edit"></i></a></td>
                                    <td>{{ $member->last_name }} - {{ $member->first_name }}</td>
                                    <td>{{ $member->category->title }}</td>
                                    <td>{{ $member->sex }}</td>
                                    <td>{{ $member->birth_date->format('m/d/Y') }}</td>
                                    <td>{{ $member->is_licensee }}</td>
                                    <td>{{ $member->id_licensee }}</td>
                                    <td>{{ $member->handicap }}</td>
                                    <td>{{ $member->bonus }}</td>
                                    <td class="addNewScore">
                                        {{--  <a href="{{ route('admin.scores.index', $member->id) }}" class="adminMemberPicture__links">
                                            <i class="glyphicon glyphicon-list-alt"></i>
                                        </a>  --}}
                                        <a href="{{ route('admin.scores.create', $member->id) }}" class="adminMemberPicture__links">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Nom - Prénom</th>
                                <th>Cat&eacute;gorie</th>
                                <th>Sex</th>
                                <th>Date de naissance</th>
                                <th>Status</th>
                                <th>Num&eacute;ro de licence</th>
                                <th>Handicap</th>
                                <th>Bonus</th>
                                <th>Gestion des scores</th>
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