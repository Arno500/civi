@extends('layouts.app')


@section('content')


    <div class="container">
        <div class="row">
            <a href="{{ route('offers') }}"><i class="material-icons icon-in-link">arrow_back</i> Retourner aux offres</a>
        </div>
        <div class="row">
            {{ $offer->name }}
            <br>
            {{ $offer->description }}
            <br>
            {{ $offer->enterprise->name }}
            <br>
            <a href="{{ $offer->enterprise->website }}">{{ $offer->enterprise->website }}</a>
            <br>
            {{ $offer->duration() }}
        </div>
    </div>

@endsection