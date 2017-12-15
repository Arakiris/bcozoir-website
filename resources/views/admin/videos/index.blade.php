@extends('layouts.admin')

@section('content')

@if(Session::has('notification_management_admin'))
    <div class="notification">
        <span class="notification__text">{{session('notification_management_admin')}}</span>
    </div>
@endif

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Gestion des vidéos</h1>

    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Videos</li>
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
                    <h3 class="box-title">Vidéos : {{ ($type=='actualite') ? 'actualité' : $type }} - {{ $data->title }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="POST" action="/administration/videos" >
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
                                    <th>Vidéo</th>
                                    <th>Chemin mp4</th>
                                    <th>Chemin webm</th>
                                </tr>
                            </thead>

                            <tbody>
                            @if($data)
                                @foreach($data->Videos as $video)
                                <tr>
                                    <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{ $video->id }}"></td>
                                    <td>{{ $video->id }}</td>
                                    <td>
                                        <video width="320" height="240" controls>
                                            <source src="{{ ($video->path_mp4) ? asset('storage' . $video->path_mp4) : null }}" type="video/mp4">
                                            <source src="{{ ($video->path_webm) ? asset('storage' . $video->path_webm) : null }}" type="video/ogg">
                                            Votre navigateur internet ne support pas les tags vidéos.
                                        </video>
                                    </td>
                                    <td>{{ $video->path_mp4 }}</td>
                                    <td>{{ $video->path_webm }}</td>
                                </tr>
                                @endforeach
                            @endif
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th><input type="checkbox" id="options"></th>
                                    <th>ID</th>
                                    <th>Vidéo</th> 
                                    <th>Chemin mp4</th>
                                    <th>Chemin webm</th>
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
