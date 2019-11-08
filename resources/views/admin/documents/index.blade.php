@extends('layouts.admin')
@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des documents divers</h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>Documents divers</li>
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
                    <h3 class="box-title">Données concernant les documents divers</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover sortingTable2">
                        <thead>
                            <tr>
                                <td></td>
                                <th>type</th>
                                <th>Nom</th>
                                <th>Type de fichier</th>
                                <th>Fichier</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if($documents)
                            @foreach($documents as $document)
                            <tr>
                                <td class="addNewScore"><a href="{{ route('admin.documents.edit', $document->id) }}"><i class="fa fa-edit"></i></a></td>
                                <td>{{$document->type->name}}</td>
                                <td>{{ isset($document->name) ? $document->name : ''}}</td>
                                <td>{{ isset($document->file_type) ? $document->file_type : ''}}</td>
                                <td>
                                    @if (isset($document->file_path))
                                        <a href="{{ asset('storage' . $document->file_path) }}" target="_blank">Fichier</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>

                        <tfoot>
                            <tr>
                                <td></td>
                                <th>type</th>
                                <th>Nom</th>
                                <th>Type de fichier</th>
                                <th>Fichier</th>
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
                    <h3 class="box-title">Cr&eacute;er un nouveau document</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <form method="POST" action="/administration/documents" enctype="multipart/form-data" role="form">
                        {{ csrf_field() }}

                        <!-- select -->
                        @if (isset($types))
                            <div class="form-group">
                                <label>Type de documents</label>
                                <select class="form-control" id="document_type_id" name="document_type_id" required>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}"> {{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <p>Veuillez créer un type de documents avant de créer un nouveau document divers</p>
                        @endif

                        <!-- text input -->
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Veuillez entrer le nom du document">
                        </div>

                        <!-- text input -->
                        <div class="form-group">
                            <label for="file_type">type de fichier</label>
                            <input type="text" id="file_type" name="file_type" class="form-control" placeholder="Veuillez entrer le type de fichier du document">
                        </div>

                        <div class="form-group">
                            <label for="file_path">Fichier</label>
                            <input type="file" id="file_path" name="file_path">
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