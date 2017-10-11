@extends('layouts.admin')

@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des Photos</h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Photos</li>
        <li class="active">Index</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Photos : {{ ($type=='actualite') ? 'actualité' : $type }} - {{ $data->title }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="POST" action="/admin/photos" >
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        <div class="form-group">
                             <button type="submit" id="delete" class="btn btn-primary">Supprimer</button>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="options"></th>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Chemin</th>
                                </tr>
                            </thead>

                            <tbody>
                            @if($data)
                                @foreach($data->pictures as $picture)
                                <tr>
                                    <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{ $picture->id }}"></td>
                                    <td>{{ $picture->id }}</td>
                                    <td>
                                        <img src="{{ ($picture) ? asset('storage' . $picture->path) : null }}" 
                                        alt="Photos" class ="tablePicture">
                                    </td>
                                    <td>{{ $picture->path }}</td>
                                </tr>
                                @endforeach
                            @endif
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th><input type="checkbox" id="options"></th>
                                    <th>ID</th>
                                    <th>Photo</th> 
                                    <th>Chemin</th>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
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
            $('#delete').hide();
            $('.checkBoxes').each(function(){
                if(this.checked)
                    $('#delete').show();
            });
            $('#options').click(function(){
                if(this.checked){
                    $('.checkBoxes').each(function(){
                        this.checked = true;
                        $('#delete').show();
                    });
                }
                else {
                    $('.checkBoxes').each(function(){
                        this.checked = false;
                        $('#delete').hide();
                    });
                }
            });
            $('.checkBoxes').click(function(){
                var show = false;
                 $('.checkBoxes').each(function(){
                    if(this.checked)
                        show = true;
                });

                if(show)
                    $('#delete').show();
                else
                    $('#delete').hide();
            });
        });
    </script>
@endsection
