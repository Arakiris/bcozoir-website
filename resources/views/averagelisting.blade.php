@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="membres listing" />
@endsection


@section('content')
    <div class="main-content-averagelisting">
        @if(isset($warnings) && !is_null($warnings))
            <div class="main-content-title">
        @else
            <div class="main-content-title margin-top-30">
        @endif
            <h1>Listing <?php setlocale(LC_TIME, 'fr'); echo utf8_encode(strftime("%B %Y")); ?></h1>
        </div>
        @if(isset($members) && $members->count()>0)
            <table class="table-averagelisting">
                <thead>
                    <th class="td-witdth15">N° Licence</th>
                    <th class="td-witdth5">Sexe</th>
                    <th class="td-witdth10">Catégorie</th>
                    <th class="td-witdth15">Nom</th>
                    <th class="td-witdth15">Prénom</th>
                    <th class="td-witdth10">Nb lignes</th>
                    <th class="td-witdth10">Moyenne</th>
                    <th class="td-witdth10">Handicap</th>
                    <th class="td-witdth10">Bonus</th>
                </thead>
                <tbody>
                    @foreach($members as $member)
                        @if(isset($member->score) && $member->is_licensee=='Licencié')
                            <tr>
                                <td>{{ $member->id_licensee }}</td>
                                <td>{{ ($member->sex == 'm') ? 'H' : 'F' }}</td>
                                <td>{{ $member->category->title }}</td>
                                <td class="tooltip-averagelisting">
                                    {{ $member->last_name }}
                                    <div class="tooltiptext">
                                        <img src="{{ ($member->historical_path) ? asset('storage' . $member->historical_path) : null }}" alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
                                    </div>
                                </td>
                                <td>{{ $member->first_name }}</td>
                                <td>{{ $member->score->number_lines }}</td>
                                <td>{{ $member->score->average ? intval($member->score->average) : ''  }}</td>
                                <td>{{ $member->handicap }}</td>
                                <td>{{ $member->bonus }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="bottom-div">
                <div class="pagination-middle">
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