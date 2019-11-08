@extends('layouts.admin')
@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des types de document divers</h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Type - document divers</li>
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
                    <h3 class="box-title">Données concernant les types de document divers</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover sortingTable2">
                        <thead>
                            <tr>
                                <td></td>
                                <th>Id</th>
                                <th>Nom</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if($types)
                            @foreach($types as $type)
                            <tr>
                                <td class="addNewScore"><a href="{{ route('admin.documentTypes.edit', $type->id) }}"><i class="fa fa-edit"></i></a></td>
                                <td>{{$type->id}}</td>
                                <td>{{$type->name}}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>

                        <tfoot>
                            <tr>
                                <td></td>
                                <th>Id</th>
                                <th>Nom</th>
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
                    <h3 class="box-title">Cr&eacute;er un nouveau type de document</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <form method="POST" action="/administration/document-types" role="form">
                        {{ csrf_field() }}

                        <!-- text input -->
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Veuillez entrer le nom du partenaire" required>
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