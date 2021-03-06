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
                        <form method="POST" action="/administration/tournois/{{$tournament->id}}/equipe" role="form">
                            {{csrf_field()}}
                            
                            <div class="form-group">
                                 <button type="submit" id="save" class="btn btn-primary">Sauvegarder</button>
                            </div>

                            <!-- text input -->
                            <div class="form-group">
                                <label for="name">Nom de l'équipe</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Veuillez entrer le nom de l'équipe">
                            </div>

                            <!-- radio -->
                            <div class="form-group">
                                <label for="display_rank">Afficher le classement ?</label>
                                <div class="radio radiobutton">
                                    <label>
                                        <input type="radio" name="display_rank"  value="0" checked>
                                        Non
                                    </label>
                                    <label class="margin-right-15">
                                        <input type="radio" name="display_rank"  value="1">
                                        Oui
                                    </label>
                                </div>
                            </div>

                            <div class="form-group margin-top-30">
                                <label for="name">Nom du membre à ajouter</label>
                                <input id="autocomplete-members" class="dropdown-input"/>
                            </div>
        
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nom - Prénom</th>
                                        <th></th>
                                    </tr>
                                </thead>
    
                                <tbody id="add-members">
                        
                                </tbody>
    
                                <tfoot>
                                    <tr>
                                        <th>Nom - Prénom</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="box-footer col-xs-8">
                                <button type="submit" class="btn btn-primary" name="submitbutton" value="save">Sauvegarder</button>
                            </div>
                        </form>
                        <div class="box-footer col-xs-4 pull-right">
                            <a class="btn btn-default pull-right" href="{{ route('admin.tournois.edit', $tournament->id) }}">Retour</a>
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
        let inputmember = document.getElementById("autocomplete-members");
        let addmember = document.getElementById("add-members");
        let count = 0;
        let currentInput = "";

        inputmember.addEventListener("keydown", (e) => {
            if(e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });

        new Awesomplete(inputmember, {
            minChars: 0,
            list: [
                @if($members)
                    @foreach($members as $member)
                        <?php echo "{label: \"" . $member->last_name . " " . $member->first_name . "\", value: \"" . $member->id  . "\" },"; ?>
                    @endforeach
                @endif
            ],
            replace:  function(suggestion){
                this.input.value = suggestion.label;
            }
        }, false);

        inputmember.addEventListener("awesomplete-selectcomplete", event => {
            renderAddingMember(event.text.value, event.text.label);

            event.target.value = null;
        }, false);

        addmember.addEventListener("click", event => {
            if(event.target && event.target.classList.contains("btn-delete-member")){
                const member = event.target.closest(".member");

                member.parentElement.removeChild(member);
            }
        }, false)

        const renderAddingMember = (id, name) => {
            const markup = `
                <tr class="member">
                    <td><input type="hidden" name="members[${count}][id]" class="form-control" value="${id}">${name}</td>
                    <td><input type="text" name="members[${count}][rank]" class="form-control" placeholder="Insérer son classement si existant"></td>
                    <td> <button class="btn-delete-member" type="button">Retirer le joueur</button> </td>
                </tr>
            `;
            
            addmember.insertAdjacentHTML("beforeend", markup);
            
            count++;
        };
    </script>
@endsection