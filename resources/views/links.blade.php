@extends('layouts.master')

@section('content')
    <div class="partners">
        @if(isset($warnings) && !is_null($warnings))
            <div class="main-content-title">
        @else
            <div class="main-content-title margin-top-30">
        @endif
            <h1>Liens utiles</h1>
        </div>
        <div class="main-content-partners">
            <table class="table-associate">
                <col style="width: 140px">
                <col style="width: 100%">
                <tbody>
                    @foreach($links as $link)
                        <tr>
                            <td><div class="cell-logo"><img class="logo-associate" src="{{ ($link->picture->first()->path) ? asset('storage' . $link->picture->first()->path) : null }}" alt="Image du liens: {{ $link->title }}"></div></td>
                            <td class="text-associate-link">{{ $link->title }}<br><a href="{{ $link->link }}" target="_blank">{{ $link->link }}</a> </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="page">
            {{ $links->links() }}
        </div>
    </div>
@endsection