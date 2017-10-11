
@extends('layouts.admin') @section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des clubs du site internet </h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i>Membres</li>
        <li class="active">Edit</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- left column -->
    <div class="col-xs-12">

        <!-- general form elements disabled -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">&Eacute;dition un membre</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <form method="POST" action="/admin/membres/{{ $member->id }}" enctype="multipart/form-data" role="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="col-sm-3">
                            <div class="form-group">
                                <img src="{{ ($member->picture->first()) ? asset('storage/' . $member->picture->first()->path) : null }}" alt="Avatar du membre" class ="adminMemberPicture">
                            </div>
                            <div class="form-group textAlignCenter">
                                <input type="file" id="image" name="image" class="inputfile" accept="image/*">
                                <label for="image"><i class="fa fa-fw fa-upload"></i> Modifier l'avatar</label>
                            </div>
                        </div>

                        <div class="col-sm-9">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="last_name">Nom</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Veuillez entrer le nom" value="{{ $member->last_name }}" required>
                            </div>

                            <!-- text input -->
                            <div class="form-group">
                                <label for="first_name">Prénom</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Veuillez entrer le prénom" value="{{ $member->first_name }}" required>
                            </div>

                            <!-- date input -->
                            <div class="form-group">
                                <label for="birth_date">Date de naissance</label>
                                <input type="date" id="birth_date" name="birth_date" class="form-control" value="{{ \Carbon\Carbon::createFromFormat('d/m/Y', $member->birth_date)->format('Y-m-d') }}" required>
                            </div>

                            <div class="col-md-6">
                                <!-- radio -->
                                <div class="form-group">
                                    <label for="sex">Sexe</label>
                                    <div class="radio radiobutton">
                                        <label class="margin-right-15">
                                            <input type="radio" name="sex" id="sex" value="m" {{ ($member->sex == 'm') ? 'checked' : '' }} >
                                            Homme
                                        </label>
                                        <label>
                                            <input type="radio" name="sex" id="sex" value="f" {{ ($member->sex == 'f') ? 'checked' : '' }} >
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
                                            <input type="radio" name="is_licensee" id="is_licensee" value="0" {{ ($member->is_licensee == 0) ? "checked" : "" }}>
                                            Adh&eacute;rent
                                        </label>
                                        <label>
                                            <input type="radio" name="is_licensee" id="is_licensee" value="1" {{ ($member->is_licensee == 1) ? "checked" : "" }}>
                                            Licenci&eacute;
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- text input -->
                            <div class="form-group">
                                <label for="id_licensee">Num&eacute;ro de licence</label>
                                <input type="text" id="id_licensee" name="id_licensee" class="form-control" placeholder="Veuillez entrer le numéro de licence" value="{{ $member->id_licensee }}" {{ ($member->is_licensee == 0) ? "disabled" : "" }}>
                            </div>

                            <!-- select -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Club</label>
                                    <select class="form-control" id="club_id" name="club_id" required>
                                        @foreach($clubs as $club)
                                            <option value="{{ $club->id }}" {{ ($member->id_club == $club->id) ? 'selected' : '' }}> {{ $club->name }}</option>
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
                                            <option value="{{ $category->id }}" {{ ($member->id_category == $category->id) ? 'selected' : '' }}> {{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <!-- text input -->
                            <div class="form-group">
                                <label for="bonus">Bonus</label>
                                <input type="text" id="bonus" name="bonus" class="form-control" placeholder="Veuillez entrer le numéro de licence" value="{{ $member->bonus }}" >
                            </div>

                            @include('partials._form-error')

                        </div>

                        <div class="box-footer col-xs-6">
                            <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Mettre-à-jour</button>
                        </div>
                    </form>
                    <div class="box-footer col-xs-6 pull-right">
                        <form method="POST" action="/admin/membres/{{ $member->id }}" role="form">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger pull-right margin-right-10">Détruire</button>
                            <a href="{{ route('admin.membres.index') }}" class="btn btn-default pull-right margin-right-10">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection