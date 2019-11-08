@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="membres listing" />
@endsection


@section('content')
<div class="content__title">
    <h1 class="heading-1">Listing National FFBSQ</h1>
</div>
<div class="average-listing">
    @if(isset($members) && $members->count()>0)
        <table class="table">
            <thead>
                <th class="table__th table__witdth-15">N° Licence</th>
                <th class="table__th table__witdth-5">Sexe</th>
                <th class="table__th table__witdth-10">Catégorie</th>
                <th class="table__th table__witdth-15">Nom</th>
                <th class="table__th table__witdth-15">Prénom</th>
                <th class="table__th table__witdth-10">Nb lignes</th>
                <th class="table__th table__witdth-10">Moyenne</th>
                <th class="table__th table__witdth-10">Handicap</th>
                <th class="table__th table__witdth-10">Bonus vétéran</th>
            </thead>
            <tbody>
                @foreach($members as $member)
                    @if(isset($member->score) && $member->is_licensee=='Licencié')
                        <tr class="table__tr">
                            @if (isset($member->listing_url))
                                <td class="table__td">
                                    <a class="table__link" href="{{ $member->listing_url }}" target="_blank" class="decoration-none block">{{ $member->id_licensee }}</a>
                                </td>
                            @else
                                <td class="table__td">{{ $member->id_licensee }}</td>
                            @endif
                            
                            <td class="table__td">{{ ($member->sex == 'm') ? 'H' : 'F' }}</td>
                            <td class="table__td">{{ $member->category->title }}</td>
                            <td class="table__td table__tooltip">
                                {{ $member->last_name }}
                                <div class="table__tooltip-content">
                                    <img class="table__tooltip-img" src="{{ ($member->historical_path) ? asset('storage' . $member->historical_path) : null }}" alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
                                </div>
                            </td>
                            <td class="table__td">{{ $member->first_name }}</td>
                            <td class="table__td">{{ $member->score->number_lines }}</td>
                            <td class="table__td">{{ $member->score->average ? intval($member->score->average) : ''  }}</td>
                            <td class="table__td">{{ $member->handicap }}</td>
                            <td class="table__td">{{ $member->bonus }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="average-listing__bottom">
            <div class="pagination bottom-div">
                {{ $members->links() }}
            </div>
        </div>
    @else
        <div class="main-content-news">
            <p>Il n'y a pas encore de listing d'enregistrer.</p>
        </div>
    @endif
</div>
@endsection