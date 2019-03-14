@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="adresses utiles" />
@endsection

@section('content')
    @if(isset($warnings) && !is_null($warnings))
        <div class="main-content-title">
    @else
        <div class="main-content-title margin-top-30">
    @endif
        <h1>Adresses</h1>
    </div>
    <div class="main-content-address">
        <h2><u>Bowling Club d'Ozoir</u></h2>
        <p>4 Rue Charles Dullin <br>
           77330 Ozoir-la-Ferrière <br>
           ☎ 06.58.00.51.08 (Alain Rousseau) - Web: www.bcozoir.com <br><br>
        </p>
        <h2><u>Secrétariat administratif FFBSQ</u></h2>
        <p>Mme Claudie TRAINEAU <br>
           Résidence les Acacias <br>
           5 Rue du Rossignol <br>
           Bât. A3 - Appt. 66 <br>
           33600 PESSAC <br>
           ☎ 06.72.40.81.78 - ✉ cifruiz@aol.com <br><br>
        </p>
        <h2><u>Présidente LRIDF-FFBSQ</u></h2>
        <p>Mme Bottecchia Nicole-France <br>
           95 Rue Jules Ferry <br>
           92700 Colombes <br>
           ☎ 06.68.53.23.79 - ✉ comitecif@free.fr <br><br>
        </p>        
    </div>
@endsection