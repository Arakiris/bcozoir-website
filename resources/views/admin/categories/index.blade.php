@extends('layouts.admin')
@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des cat&eacute;gories d'&acirc;ge</h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Cat&eacute;gorie</li>
        <li class="active">Index</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Données concernant les cat&eacute;gories d'&acirc;ge</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover sortingTable2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Nom de la cat&eacute;gorie</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if($categories)
                            @foreach($categories as $category)
                            <tr>
                                <td class="addNewScore"><a href="{{ route('admin.categories.edit', $category->id) }}"><i class="fa fa-edit"></i></a></td>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->title }}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Nom de la cat&eacute;gorie</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
         <!-- /.col -->

        <div class="col-md-6">

            <!-- general form elements disabled -->
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Cr&eacute;er une nouvelle cat&eacute;gorie</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <form method="POST" action="/administration/categories" role="form">
                        {{ csrf_field() }}

                        <!-- text input -->
                        <div class="form-group">
                            <label for="title">Intitul&eacute;</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Veuillez entrer l'intitulé de la catégorie" required>
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