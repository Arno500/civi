@extends('layouts.app')

@section('content')

<div class="container">
    @if(Auth::user()->enterprise !== null)
    <div class="row">
        <div class="row">
            <a href="{{ route('offers.create') }}"><i class="material-icons icon-in-link">note_add</i> Créer une offre</a>
        </div>
    </div>
    @endif
    <div class="row">
    @if($offers->isEmpty())
        <p>Oups, il n'y aucune offre disponible... Revenez un peu plus tard !</p>
    @else
    @foreach($offers as $offer)
        <a class="offer-link" href="{{ '/offers/'.$offer->id }}">
        <div class="card card-horizontal-md-up card-offer">
            <img class="card-img" src="{{ asset($offer->enterprise->logourl) }}" alt="{{ $offer->enterprise->name }}">
            <div class="card-block">
                <h5 class="card-title">{{$offer->name}}</h5>
                <p class="card-text">{{ $offer->description }}</p>
                <br>
                {{ $offer->enterprise->name  }}
            </div>

        </div>
        </a>

    @endforeach
        </div>

        {{ $offers->links() }}
    @endif

</div>


@endsection