@extends('connect.master')
@section('title','Registrarse')

@section('content')
    <div class="box box_register shadow">

        <div class="header">
            <a href="{{ url('/') }}">
                <img src="{{ url('/static/images/logo.png') }}">
            </a>
        </div>

        <div class="inside">
            {!! Form::open(['url' => '/register']) !!}

                <label for="name">Nombre:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    {!! Form::text('name', null, ['id'=>'name','class' => 'form-control','required'])!!}
                </div>

                <label for="lastname" class="mtop16">Apellido:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                    {!! Form::text('lastname', null, ['id'=>'lastname','class' => 'form-control','required'])!!}
                </div>

                <label for="email" class="mtop16">Correo Electrónico:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="far fa-envelope-open"></i></span>
                    {!! Form::email('email', null, ['id'=>'email','class' => 'form-control','required'])!!}
                </div>

                <label for="password" class="mtop16">Password:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    {!! Form::password('password', ['id'=>'password','class' => 'form-control','required'])!!}
                </div>

                <label for="cpassword" class="mtop16">Confirmar Password:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    {!! Form::password('cpassword', ['id'=>'cpassword','class' => 'form-control','required'])!!}
                </div>

                {!! Form::submit('Registrarse',['class' => 'btn btn-success mtop16']) !!}

            {!! Form::close() !!}

            @include('common.alert')

            <div class="footer mtop16">
                <a href="{{ url('/login') }}">Ya Tengo Una Cuenta, Iniciar Sesión</a>
            </div>

        </div>

    </div>
@stop
