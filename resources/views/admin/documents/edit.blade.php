@extends('layouts.admin')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des document divers</h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Documents divers</li>
        <li class="active">&Eacute;dition</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-xs-12">

            <!-- general form elements disabled -->
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">&Eacute;diter un document</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <form method="POST" action="/administration/documents/{{ $document->id }}" enctype="multipart/form-data" role="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <!-- select -->
                        @if (isset($types))
                            <div class="form-group">
                                <label>Type de documents</label>
                                <select class="form-control" id="document_type_id" name="document_type_id" required>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{ ($type->id == $document->document_type_id) ? 'selected' : '' }}> {{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <p>Veuillez créer un type de documents avant de créer un nouveau document divers</p>
                        @endif

                        <!-- text input -->
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Veuillez entrer le nom du document" value="{{ isset($document->name) ? $document->name   : '' }}">
                        </div>

                        <!-- text input -->
                        <div class="form-group">
                            <label for="file_type">type de fichier</label>
                            <input type="text" id="file_type" name="file_type" class="form-control" placeholder="Veuillez entrer le type de fichier du document" value="{{ isset($document->file_type) ? $document->file_type   : '' }}">
                        </div>

                        <div class="form-group">
                            <label for="file_path">Fichier</label>
                            <input type="file" id="file_path" name="file_path">
                        </div>

                        @include('partials._form-error')

                        <div class="box-footer col-xs-6">
                            <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Mettre-à-jour</button>
                        </div>
                    </form>
                    <div class="box-footer col-xs-6 pull-right">
                        <form method="POST" action="/administration/documents/{{ $document->id }}" role="form">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger pull-right margin-right-10">Détruire</button>
                            <a href="{{ route('admin.documents.index') }}" class="btn btn-default pull-right margin-right-10">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->
@endsection