@extends('layouts.admin')
@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des membres du site internet </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Membres</li>
        <li class="active">Cr&eacute;ation</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- left column -->
    <div class="col-xs-12">

        <!-- general form elements disabled -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Cr&eacute;er un nouveau membre</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <form method="POST" action="/administration/membres" enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="image">Photo</label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>
                    <!-- text input -->
                    <div class="form-group">
                        <label for="last_name">Nom</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Veuillez entrer le nom" required>
                    </div>

                    <!-- text input -->
                    <div class="form-group">
                        <label for="first_name">Prénom</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Veuillez entrer le prénom" required>
                    </div>

                    <!-- date input -->
                    <div class="form-group">
                        <label for="birth_date">Date de naissance</label>
                        <input type="date" id="birth_date" name="birth_date" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <!-- radio -->
                        <div class="form-group">
                            <label for="sex">Sexe</label>
                            <div class="radio radiobutton">
                                <label class="margin-right-15">
                                    <input type="radio" name="sex" id="sex" value="m" checked>
                                    Homme
                                </label>
                                <label>
                                    <input type="radio" name="sex" id="sex" value="f">
                                    Femme
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <!-- radio -->
                        <div class="form-group">
                            <label for="is_licensee">Status</label>
                            <div class="radio radiobutton">
                                <label class="margin-right-15">
                                    <input type="radio" name="is_licensee" id="is_licensee" value="0" checked>
                                    Adh&eacute;rent
                                </label>
                                <label>
                                    <input type="radio" name="is_licensee" id="is_licensee" value="1">
                                    Licenci&eacute;
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- text input -->
                    <div class="form-group">
                        <label for="id_licensee">Num&eacute;ro de licence</label>
                        <input type="text" id="id_licensee" name="id_licensee" class="form-control" placeholder="Veuillez entrer le numéro de licence" disabled>
                    </div>

                    <!-- select -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Club</label>
                            <select class="form-control" id="club_id" name="club_id" required>
                                @foreach($clubs as $club)
                                    <option value="{{ $club->id }}"> {{ $club->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- select -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cat&eacute;gorie</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <!-- text input -->
                    <div class="form-group">
                        <label for="bonus">Bonus</label>
                        <input type="text" id="bonus" name="bonus" class="form-control" placeholder="Veuillez entrer le bonus">
                    </div>

                    @include('partials._form-error')

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Enregistrer</button>
                        
                        <div class="pull-right">
                            <a href="{{ route('admin.membres.index') }}" class="btn btn-default">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection