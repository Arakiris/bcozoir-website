@extends('layouts.master')

@section('content')
    <div class="main-content-title">
        <h1>Listing <?php setlocale(LC_TIME, 'fr'); echo strftime("%B %Y"); ?></h1>
    </div>
    @if(isset($members) && $members->count()>0)
        <div class="main-content-averagelisting">
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
                                <td class="tooltip">
                                    {{ $member->last_name }}
                                    <div class="tooltiptext">
                                        <img src="{{ ($member->picture->first()->path) ? asset('storage' . $member->picture->first()->path) : null }}" alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
                                    </div>
                                </td>
                                <td>{{ $member->first_name }}</td>
                                <td>{{ $member->score->number_lines }}</td>
                                <td>{{ $member->score->average }}</td>
                                <td>{{ floor((220 - $member->score->average)*0.7) }}</td>
                                <td>{{ $member->bonus }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="bottom-div">
                <div>
                    {{ $members->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="main-content-news">
            <p>Il n'y a pas encore de listing d'enregistrer.</p>
        </div>
    @endif
@endsection