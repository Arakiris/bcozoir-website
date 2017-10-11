@extends('layouts.admin') @section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des cat&eacute;gories d'&acirc;ge</h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Cat&eacute;gorie</li>
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
                    <h3 class="box-title">&Eacute;diter une cat&eacute;gorie</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <form method="POST" action="/admin/categories/{{ $category->id }}" role="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <!-- text input -->
                        <div class="form-group">
                            <label for="title">Intitul&eacute;</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Veuillez entrer l\'intitulé de la catégorie" value="{{ $category->title }}" required>
                        </div>

                        @include('partials._form-error')

                        <div class="box-footer col-xs-6">
                            <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Mettre-à-jour</button>
                        </div>
                    </form>
                    <div class="box-footer col-xs-6 pull-right">
                        <form method="POST" action="/admin/categories/{{ $category->id }}" role="form">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger pull-right margin-right-10">Détruire</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-default pull-right margin-right-10">Annuler</a>
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