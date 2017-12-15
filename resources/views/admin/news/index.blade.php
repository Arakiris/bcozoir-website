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
                    <h3 class="box-title">Donn&eacute;es concernant les actualit&eacute;s</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover sortingTable2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Titre</th>
                                <th>Contenu</th>
                                <th>Gestion des photos</th>
                                <th>Gestion des vidéos</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if($news)
                            @foreach($news as $singleNews)
                                <tr>
                                    <td class="addNewScore"><a href="{{ route('admin.actualites.edit', $singleNews->id) }}"><i class="fa fa-edit"></i></a></td>
                                    <td>{{ $singleNews->id }}</td>
                                    <td>{{ $singleNews->title }}</td>
                                    <td>{{ $singleNews->body }}</td>
                                    <td class="addNewScore">
                                        <?php setlocale(LC_TIME, 'fr'); $datenews = strftime("%d %B %Y", strtotime($singleNews->created_at->format('Y-m-d'))); ?>
                                        <a href="{{ route('admin.photos.create', ['actualite', $singleNews->id, '(p)' . $datenews . '(pbis)']) }}" class="adminMemberPicture__links">
                                            <i class="fa fa-plus-square"></i>
                                        </a>
                                        <a href="{{ route('admin.photos.index', ['actualite', $singleNews->id]) }}" class="adminMemberPicture__links">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                    </td>
                                    <td class="addNewScore">
                                        <a href="{{ route('admin.videos.create', ['actualite', $singleNews->id]) }}" class="adminMemberPicture__links">
                                            <i class="fa fa-plus-square"></i>
                                        </a>
                                        <a href="{{ route('admin.videos.index', ['actualite', $singleNews->id]) }}" class="adminMemberPicture__links">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Titre</th>
                                <th>Contenu</th>
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