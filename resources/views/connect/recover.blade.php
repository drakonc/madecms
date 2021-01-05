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
            {!! Form::open(['url' => '/recover']) !!}

                <label for="email">Correo Electrónico:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="far fa-envelope-open"></i></span>
                    {!! Form::email('email', null, ['id'=>'email','class' => 'form-control','required'])!!}
                </div>

                <label for="password">Contraseña:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    {!! Form::password('password', ['id'=>'password','class' => 'form-control','required'])!!}
                </div>

                <label for="cpassword">Confirmar Contraseña:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    {!! Form::password('cpassword', ['id'=>'cpassword','class' => 'form-control','required'])!!}
                </div>

                {!! Form::submit('Recuperar Contraseña',['class' => 'btn btn-success mtop16']) !!}

            {!! Form::close() !!}

            @include('common.alert')

            <div class="footer mtop16">
                <a href="{{ url('/register') }}">¿No tienes una cuenta?, Registrarse</a>
                <a href="{{ url('/login') }}">Ingresar a mi Cuenta</a>
            </div>

        </div>

    </div>
@stop
