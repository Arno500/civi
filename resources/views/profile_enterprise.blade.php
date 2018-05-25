@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-8">
                <div class="card mx-auto">
                    <div class="card-header"><h1>Bonjour, {{ Auth::user()->name }} !</h1></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="btn-group btn-group-justified" role="group" aria-label="Sections du site">
                            <a class="btn" href="{{ route('offers.create') }}">Créer une offre</a>
                            <a class="btn" href="{{ route('offers') }}">Accéder aux offres</a>
                            <a class="btn" href="{{ route('search') }}">Accéder aux étudiants</a>
                            <a class="btn" href="{{ route('profile.modify') }}">Modifier mes informations</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
