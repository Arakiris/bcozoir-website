@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="membres listing" />
@endsection


@section('content')
<div class="content__title">
    <h1 class="heading-1">Documents divers</h1>
    <p class="content__paragraph">Cliquer sur le libellé pour accéder au fichier</p>
</div>
<div class="documents">
    @if(isset($types) && !empty($types))
        <div class="documents__content">
            @foreach ($types as $type)
                @if (isset($type->documents) && !empty($type->documents) && $type->documents->count() > 0)
                    <div class="documents__type">{{$type->name}}</div>
                    @foreach ($type->documents as $document)
                        <a class="documents__link" href="{{ isset($document->file_path) ? asset('storage' . $document->file_path) : '#'}}" download>
                            <div class="documents__single-name">
                                {{$document->name}}
                            </div>
                            <div class="documents__single-type">
                                {{strtoupper($document->file_type)}}
                            </div>
                        </a>
                    @endforeach
                @endif
            @endforeach
        </div>
    @else
        <div class="documents__content">
            <p>Il n'y a pas encore de document enregistré.</p>
        </div>
    @endif
</div>
@endsection