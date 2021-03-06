@extends("layouts.app")

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-8">
                <div class="card">
                    <div class="card-header">Modifier vos données</div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('profile.update') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">Nom d'utilisateur</label>

                                <input id="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                       value="{{ old('name', Auth::user()->name) }}" autofocus autocomplete="username">

                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">Adresse de couriel</label>
                                <input id="email" type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                       value="{{ old('email', Auth::user()->email) }}" autocomplete="mail">

                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Mot de passe</label>

                                <input id="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" aria-describedby="passwordHelpBlock" autocomplete="new-password">
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
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label for="enterprise">Entreprise</label>
                                <input id="enterprise" type="text" class="form-control" name="enterprise"
                                       value="{{ old('enterprise', App\Enterprise::find(Auth::user()->enterprise)->name) }}" autocomplete="organization">
                            </div>

                            <div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                                <label for="password">Mot de passe actuel</label>

                                <input id="oldpassword" type="password"
                                       class="form-control{{ $errors->has('oldpassword') ? ' is-invalid' : '' }}"
                                       name="oldpassword" autocomplete="old-password" required>
                                @if ($errors->has('oldpassword'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('oldpassword') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
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