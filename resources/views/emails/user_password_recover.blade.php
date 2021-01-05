@extends('emails.master')
@section('content')
    <p>Hola: <strong>{{ $name }}</strong></p>
    <p>Este es un corro electrónico que le ayudara a reestablecer la contraseña de su cuenta en nuestra plataforma.</p>
    <p>Para continuar haga clic en el siguiente botón e ingrese el siguiente código: <h2>{{ $code  }}</h2></p>
    <p>
        <a href="{{ url('/reset?email='.$email ) }}" style="background-color: #2caaff; border-radius: 4px; color: #fff; display: inline-block; padding:12px; text-decoration: none">
            Resetear Mi Contraseña
        </a>
    </p>
    <p>Si el botón anterior no le funciona, copie y pegue la siguiente URL en su navegador:</p>
    <p>{{ url('/reset?email='.$email ) }}</p>
@endsection
