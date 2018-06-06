@extends('layouts.app')

@section('content')
<div class="container margin-content">
    <div class="row">
            <div class="column">
                <div class="card">
                <div class="card-header">Mot de passe oublié</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Adresse de couriel</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Envoyer un lien de récupération
                                </button>
                        </div>
                    </form>
                </div>
        </div></div>
    </div>
</div>
@endsection
