@extends('layouts.app')

@section('content')
    <div class="container" id="register">
        <div class="row">
            <div class="column">
                <div class="card">
                    <div class="card-header">Inscription</div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">Nom d'utilisateur</label>

                                <input id="name" type="text"
                                       class="form-control button-shadow{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                       value="{{ request('name', old('name')) }}" required autofocus autocomplete="username">

                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">Adresse de couriel</label>
                                <input id="email" type="email"
                                       class="form-control button-shadow{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                       value="{{ request('email', old('email')) }}" required autocomplete="mail">

                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Mot de passe</label>

                                <input id="password" type="password"
                                       class="form-control button-shadow{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" required aria-describedby="passwordHelpBlock" autocomplete="new-password">
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Votre mot de passe doit contenir au moins 6 caractères.
                                </small>
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password-confirm">Confirmation du mot de passe</label>
                                <input id="password-confirm" type="password" class="form-control button-shadow"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <div class="btn-group btn-group-toggle radio-toggle" data-toggle="buttons">
                                    <label class="btn radio-color button-shadow active">
                                        <input type="radio" name="account" id="studentcheck" autocomplete="off" checked> Compte étudiant
                                    </label>
                                    <label class="btn radio-color button-shadow">
                                        <input type="radio" name="account" id="enterprisecheck" autocomplete="off"> Compte entreprise
                                    </label>
                                </div>
                            </div>
                            <div class="form-group enterprise-group">
                                <label for="enterprise">Entreprise</label>
                                <input id="enterprise" type="text" class="form-control button-shadow" name="enterprise"
                                       value="{{ old('enterprise') }}" autocomplete="organization">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="button button-shadow">
                                    Continuer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
