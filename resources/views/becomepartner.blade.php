@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="mentions légales" />
@endsection


@section('content')
<div class="content__title">
    <h1 class="heading-1">Appel partenaires</h1>
</div>
<div class="become-partner">
    @if (isset($contentInformation->description))
        {!! $contentInformation->description !!}
    @endif
</div>

@endsection