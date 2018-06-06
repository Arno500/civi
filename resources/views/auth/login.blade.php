@extends('layouts.app')

@section('content')
<div class="container margin-content">
    <div class="row justify-content-md-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Connexion</div>

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email">Adresse de couriel</label>

                                <input id="email" type="email" class="form-control button-shadow{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe</label>

                                <input id="password" type="password" class="form-control button-shadow{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                        </div>

                        <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input button-shadow" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">Rester connecté</label>
                                </div>
                        </div>

                        <div class="form-group">
                                <button type="submit" class="button button-short btn-shadow">
                                    Connexion
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Mot de passe oublié ?
                                </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
