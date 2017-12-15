@extends('layouts.admin')
@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des contacts</h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Contacts</li>
        <li class="active">Index</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-md-6">
                <!-- general form elements disabled -->
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Les contacts à qui sont envoyés les mails</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="POST" action="/administration/contacts" role="form">
                            {{ csrf_field() }}

                            @foreach($contacts as $contact)
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="contact{{ $contact->id }}">Contact {{ $contact->id  }}</label>
                                    <input type="text" id="contact{{ $contact->id }}" name="name{{ $contact->id }}" value="{{ $contact->name }}" class="form-control margin-bottom-10" placeholder="Veuillez entrer le nom et prénom du contact">
                                    <input type="email" id="contact{{ $contact->id }}" name="email{{ $contact->id }}" value="{{ $contact->email }}" class="form-control" placeholder="Veuillez entrer l'email de la personne à contacter">
                                </div>
                            @endforeach

                            @include('partials._form-error')

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
         <!-- /.col -->

        <div class="col-md-6">


        </div>
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->
@endsection