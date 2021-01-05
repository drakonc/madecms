@extends('connect.master')
@section('title','Login')

@section('content')
    <div class="box box_login shadow">

        <div class="header">
            <a href="{{ url('/') }}">
                <img src="{{ url('/static/images/logo.png') }}">
            </a>
        </div>

        <div class="inside">
            {!! Form::open(['url' => '/login']) !!}

                <label for="email">Correo Electrónico:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="far fa-envelope-open"></i></span>
                    {!! Form::email('email', null, ['id'=>'email','class' => 'form-control'])!!}
                </div>

                <label for="password" class="mtop16">Password:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    {!! Form::password('password', ['id'=>'password','class' => 'form-control'])!!}
                </div>

                {!! Form::submit('Ingresar',['class' => 'btn btn-success mtop16']) !!}

            {!! Form::close() !!}

            @include('common.alert')

            <div class="footer mtop16">
                <a href="{{ url('/register') }}">¿No tienes una cuenta?, Registrarse</a>
                <a href="{{ url('/recover') }}">Recuperar Contraseña</a>
            </div>

        </div>

    </div>
@stop
