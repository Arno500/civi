@extends('layouts.app')


@section('content')


    <div class="container">
        <div class="row">
            <a href="{{ route('offers') }}"><i class="material-icons icon-in-link">arrow_back</i> Retourner aux offres</a>
        </div>
        <div class="row">

            <div class="affichage-offre-contenu">

                <div class="container affichage-offre">
                    <!-- Les infos de l'offre sont juste dans cette div -->

                    <div class="row stage">

                        <h1 class="offer-name">{{ $offer->name }}</h1>

                        <div class="description-stage">

                            <h2>Description du stage :</h2>

                            <p>{{ $offer->description }}</p>
                        </div>

                        <h2>Durée de la mission :</h2>

                        <p>{{ $offer->duration() }}</p>
                    </div>
                </div>

                <div class="entreprise">

                    <h2>{{ $offer->enterprise->name }}</h2>
                    <a class="link" href="{{ $offer->enterprise->website }}">

                        <h2>{{ $offer->enterprise->website }}</h2>
                        <img src="{{ $offer->enterprise->logourl }}" alt="Logo de {{ $offer->enterprise->name }}"
                             class="photo"> </a>
                    <br>

                    <div class="description-entreprise">

                        <p>{{ $offer->enterprise->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection