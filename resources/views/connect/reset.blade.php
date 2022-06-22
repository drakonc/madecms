@extends('connect.master')
@section('title','Recuperar Contraseña')

@section('content')
    <div class="box box_login shadow">

        <div class="header">
            <a href="{{ url('/') }}">
                <img src="{{ url('/static/images/logo.png') }}">
            </a>
        </div>

        <div class="inside">
            {!! Form::open(['url' => '/reset']) !!}

                <label for="email">Correo Electrónico:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="far fa-envelope-open"></i></span>
                    {!! Form::email('email', $email, ['id'=>'email','class' => 'form-control','required', 'disabled'])!!}
                </div>

                <label for="codigo" class="mtop16">Codigo de Recuperacion:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="far fa-envelope-open"></i></span>
                    {!! Form::number('codigo', null, ['id'=>'codigo','class' => 'form-control','required'])!!}
                </div>

                {!! Form::submit('Enviar Mi Contraseña',['class' => 'btn btn-success mtop16']) !!}

            {!! Form::close() !!}

            @include('common.alert')

            <div class="footer mtop16">
                <a href="{{ url('/register') }}">¿No tienes una cuenta?, Registrarse</a>
                <a href="{{ url('/login') }}">Ingresar a mi Cuenta</a>
            </div>

        </div>

    </div>
@stop
