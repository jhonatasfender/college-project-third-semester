@extends('layouts.app')

@section('content')
<body class="login">
    <!-- BEGIN LOGO -->
    <div class="logo">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <form class="login-form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <h3 class="form-title font-green">Área de Acesso</h3>

            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">E-mail</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="on" placeholder="E-mail" name="email" />
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Senha</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="on" placeholder="Senha" name="password" />
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
              <button type="submit" class="btn btn-block green uppercase">Entrar</button>
        </form>
        <!-- END LOGIN FORM -->
    </div>
    <div class="copyright"> {{date('Y')}} © DTA Engenharia. </div>
</body>
@endsection
