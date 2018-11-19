@extends('layouts.login')

@section('content')
    @if (count($errors) > 0)
    <div class="alert bg-red alert-dismissible notification" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Error!</strong> Revise los campos obligatorios.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Laboratorio de <b>Física</b></a>
            <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</small>
        </div>
        <div class="card">
            <div class="body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="msg">Ingresar para iniciar sesión</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id" placeholder="Numero de identificación personal" value="{{ old('id') }}" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-block btn-success waves-effect" type="submit">Ingresar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




<!--

<div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
        <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span> bracket <span
                class="tx-normal">]</span></div>
        <div class="tx-center mg-b-60">The Admin Template For Perfectionist</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <input id="email" placeholder="Enter your username" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif

            </div>
            <div class="bg-pink">
                <i class="material-icons">help</i>
            </div>  

            <div class="form-group">

                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                    name="password" required>

                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
                <a href="{{ route('password.request') }}" class="tx-info tx-12 d-block mg-t-10">{{ __('Forgot Your Password?') }}</a>
            </div>


            <button type="submit" class="btn btn-info btn-block">Sign In</button>
            <div class="mg-t-60 tx-center">Not yet a member? <a href="{{ route('register') }}" class="tx-info">Sign Up</a></div>

        </form>

    </div> login-wrapper 
</div> d-flex -->

@endsection
