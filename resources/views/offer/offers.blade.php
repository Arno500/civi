@extends('layouts.app')

@section('content')

    <div class="container">
        @if(Auth::user() && Auth::user()->enterprise !== "")
            <div class="row">
                <div class="row">
                    <a href="{{ route('offers.create') }}"><i class="material-icons icon-in-link">note_add</i> Créer une
                        offre</a>
                </div>
            </div>
        @endif
        <div class="row large">
            @if($offers->isEmpty())
                <p>Oups, il n'y aucune offre disponible... Revenez un peu plus tard !</p>
            @else
                @foreach($offers as $offer)
                    <a class="offer-link" href="{{ '/offers/'.$offer->id }}">
                        <div class="card card-horizontal card-offer">
                            <img class="card-img" src="{{ asset($offer->enterprise->logourl) }}"
                                 alt="{{ $offer->enterprise->name }}">
                            <div class="card-text-offer">
                                <h5 class="card-title">{{$offer->name}}</h5>
                                <p class="card-description">{{ str_limit($offer->description) }}</p>
                            </div>
                            <h2 class="name-firm">{{ $offer->enterprise->name  }}</h2>
                        </div>
                    </a>

                @endforeach
        </div>

        {{ $offers->links('offer.pagination') }}
        @endif

    </div>


@endsection