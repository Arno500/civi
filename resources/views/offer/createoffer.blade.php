@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <a href="{{ route('offers') }}"><i class="material-icons icon-in-link">arrow_back</i> Retourner aux offres</a>
        </div>
        <div class="row justify-content-md-center">
            <div class="col col-lg-8">
                <div class="card">
                    <div class="card-header">Ajouter une offre</div>

                    <div class="card-body">
                        <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('offers.create') }}" id="offersform">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">Nom de l'offre</label>

                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>

                                    <textarea id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required form="offersform">{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                    @endif
                            </div>

                            <div class="form-group">
                                <label for="duration">Durée du stage/de la mission en jours</label>

                                    <input id="duration" type="text" class="form-control{{ $errors->has('duration') ? ' is-invalid' : '' }}" name="duration" value="{{ old('duration') }}" required>

                                    @if ($errors->has('duration'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('duration') }}
                                    </div>
                                    @endif
                            </div>


                            <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Enregistrer
                                    </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection