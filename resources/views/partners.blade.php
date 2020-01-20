@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="partenaires" />
@endsection

@section('content')

<div class="content__title">
    <h1 class="heading-1">PARTENAIRES</h1>
</div>
<div class="partners">
    <div class="partners__wrapper">
        <div class="partners__how">
            <p class="partners__smallheading">Comment devenir partenaire</p>
            <a href="{{ route('becomePartner') }}" class="partners__link">
                <img src="images/poignee-de-main.png" alt="Image d'une poignée de main" class="partners__how-picture">
            </a>
        </div>

        <div class="partners__content">
            @foreach($partners as $partner)
                <div class="partners__logo">
                    <img class="partners__logo-img" src="{{ ($partner->picture->first()) ? asset('storage' . $partner->picture->first()->path) : null }}" alt="Logo du partenaire">
                </div>
                <div class="partners__informations">
                    @isset($partner->title)
                        <p class="partners__paragraph"> {{ $partner->title }} </p>
                    @endif
                    @isset($partner->address)
                        <p class="partners__paragraph"> {!! $partner->address !!} </p>
                    @endif
                    @isset($partner->website)
                        <p class="partners__paragraph"> Website : 
                            @isset($partner->url)
                                <a href="{{$partner->url}}" target="_blank">{{ $partner->website }}</a>
                            @else
                                {{ $partner->website }}
                            @endif
                        </p>
                    @endif
                    @isset($partner->mail)
                        <p class="partners__paragraph"> Mail : {{ $partner->mail }} </p>
                    @endif
                    @isset($partner->phone1)
                        <p class="partners__paragraph"> Téléphone1 : {{ $partner->phone1 }} </p>
                    @endif
                    @isset($partner->phone2)
                        <p class="partners__paragraph"> Téléphone2 : {{ $partner->phone2 }} </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <div class="partners__bottom">
        <div class="pagination bottom-div">
            {{ $partners->links() }}
        </div>
    </div>
</div>

@endsection