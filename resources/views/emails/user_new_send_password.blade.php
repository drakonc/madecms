@extends('emails.master')
@section('content')
    <p>Hola: <strong>{{ $name }}</strong></p>
    <p>Esta es la nueva contraseña para tu cuenta en nuestra plataforma: <h2>{{ $password }}</h2></p>
    <p>Para iniciar sesión haga clic en el siguiente botón</p>
    <p>
        <a href="{{ url('/login') }}" style="background-color: #2caaff; border-radius: 4px; color: #fff; display: inline-block; padding:12px; text-decoration: none">
            Ingresa a la Plataforma
        </a>
    </p>
    <p>Si el botón anterior no le funciona, copie y pegue la siguiente URL en su navegador:</p>
    <p>{{ url('/login') }}</p>
@endsection