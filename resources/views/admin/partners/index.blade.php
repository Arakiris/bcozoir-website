@extends('layouts.admin')
@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des partenaires</h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Partenaires</li>
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
                    <h3 class="box-title">Données concernant les partenaires</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-hover sortingTable2">
                        <thead>
                            <tr>
                                <td></td>
                                <th>Image</th>
                                <th>Adresse</th>
                            </tr>
                        </thead>

                        <tbody>
                        @if($partners)
                            @foreach($partners as $partner)
                            <tr>
                                <td class="addNewScore"><a href="{{ route('admin.partenaires.edit', $partner->id) }}"><i class="fa fa-edit"></i></a></td>
                                <td><img src="{{ ($partner->picture->first()) ? asset('storage' . $partner->picture->first()->path) : null }}" alt="Image du lien utile" class="adminTableImg"></td>
                                <td>{{ $partner->address }}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>

                        <tfoot>
                            <tr>
                                <td></td>
                                <th>Image</th>
                                <th>Adresse</th>
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
                    <h3 class="box-title">Cr&eacute;er un nouveau partenaire</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <form method="POST" action="/administration/partenaires" enctype="multipart/form-data" role="form">
                        {{ csrf_field() }}

                        <!-- text input -->
                        <div class="form-group">
                            <label for="address">Adresse</label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="Veuillez entrer l'adresse du partenaire" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image" accept="image/*">
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