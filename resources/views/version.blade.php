@extends('layouts.master')

@section('content')
    @if(isset($warnings) && !is_null($warnings))
        <div class="main-content-title">
    @else
        <div class="main-content-title margin-top-30">
    @endif
        <h1>Version 1.0.0</h1>
    </div>
    <div class="main-content-version">
        <p> &#10004; Description mises à jour … </p>
    </div>
@endsection