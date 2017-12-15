@extends('layouts.master')

@section('content')
<div class="partners">
    @if(isset($warnings) && !is_null($warnings))
        <div class="main-content-title">
    @else
        <div class="main-content-title margin-top-30">
    @endif
        <h1>Partenaires</h1>
    </div>
    <div class="main-content-partners">
        <table class="table-associate">
            <col style="width: 140px">
            <col style="width: 100%">
            <tbody>
                @foreach($partners as $partner)
                    <tr>
                        <td><div class="cell-logo"><img class="logo-associate" src="{{ ($partner->picture->first()->path) ? asset('storage' . $partner->picture->first()->path) : null }}" alt="Logo du partenaire"></div></td>
                        <td class="text-associate">{{ $partner->address }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="page">
        {{ $partners->links() }}
    </div>
</div>
@endsection