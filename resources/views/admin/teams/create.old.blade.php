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
        <li><i class="fa fa-dashboard"></i> Tournois</li>
        <li class="active">Cr&eacute;ation</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Création d'une nouvelle équipe du tournoi {{ $tournament->title }} - Saison  {{ date('Y', strtotime($tournament->start_season)) }}/{{ date('Y', strtotime($tournament->end_season)) }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="POST" action="/administration/tournois/{{$tournament->id}}/equipe" >
                            {{csrf_field()}}
                            <div class="form-group">
                                 <button type="submit" id="delete" class="btn btn-primary">Ajouter</button>
                            </div>

                            <!-- text input -->
                            <div class="form-group">
                                <label for="name">Nom de l'équipe</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Veuillez entrer le nom de l'équipe">
                            </div>

                            <table class="table table-bordered table-hover sortingTableAddPlayers">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="options"> Selection des participants</th>
                                        <th>Nom - Prénom</th>
                                        <th>Club</th>
                                    </tr>
                                </thead>
    
                                <tbody>
                                @if($members)
                                    @foreach($members as $member)
                                    <tr>
                                        <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{ $member->id }}" {{ ($member->participate) ? 'checked' : '' }}></td>
                                        <td>{{ $member->last_name }} - {{ $member->first_name }}</td>
                                        <td>{{ $member->club->name }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
    
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Nom - Prénom</th>
                                        <th>Club</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="form-group">
                                <button type="submit" id="delete" class="btn btn-primary">Ajouter</button>
                           </div>
                        </form>
                        <div>
                            <a class="btn btn-default" href="{{ route('admin.tournois.edit', $tournament->id) }}">Retour</a>
                        </div>
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

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.options').click(function(){
                if(this.checked){
                    $('.checkBoxes').each(function(){
                        this.checked = true;
                    });
                }
                else {
                    $('.checkBoxes').each(function(){
                        this.checked = false;
                    });
                }
            });
        });
    </script>
@endsection
