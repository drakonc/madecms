@extends('master')
@section('title','Editar mi Perfil')
@section('content')
    <div class="row mtop32">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-user"></i> Editar Avatar</h2>
                </div>
                <div class="inside">
                    <div class="edit_avatar">
                        {!! Form::open(['url' => '/account/edit/avatar','files' => true,'id' => 'form_avatar_edit']) !!}
                            <a  id="lnk_avatar_edit">
                                <div class="overlay" id="avatar_change_overlay"><i class="fas fa-camera"></i></div>
                                @if(is_null(Auth::user()->avatar))
                                    <img src="{{ url('/static/images/Default_Avatar.png') }}"/>
                                @else
                                    <img id="img" src="{{ url('/uploads_users/'.Auth::id().'/'.Auth::user()->avatar) }}" alt="No Imagen">
                                @endif
                            </a>
                            {!! Form::file('file_avatar',['id'=>'input_file_avatar','class' => 'form-control', 'accept'=>'image/*' , 'required']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="panel shadow mtop32">
                <div class="header">
                    <h2 class="title"><i class="fas fa-fingerprint"></i> Cambiar Contraseña</h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/account/edit/password']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <label for="apassword">Contraseña Actual:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    {!! Form::password('apassword', ['id'=>'apassword','class' => 'form-control','required'])!!}
                                </div>
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                <label for="password">Nueva Contraseña:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    {!! Form::password('password', ['id'=>'password','class' => 'form-control','required'])!!}
                                </div>
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                <label for="cpassword">Confirmar Contraseña:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    {!! Form::password('cpassword', ['id'=>'cpassword','class' => 'form-control','required'])!!}
                                </div>
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12 text-center">
                                {!! Form::submit('Cambiar Contraseña',['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-address-card"></i> Editar Información</h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/account/edit/info']) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Nombres:</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="far fa-user"></i>
                                    </span>
                                    {!! Form::text('name', Auth::user()->name, ['id'=>'name','class' => 'form-control','required'])!!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="lastname">Apellidos:</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user-tag"></i>
                                    </span>
                                    {!! Form::text('lastname', Auth::user()->lastname, ['id'=>'lastname','class' => 'form-control','required'])!!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="email">Correo Electronico:</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="far fa-envelope-open"></i>
                                    </span>
                                    {!! Form::email('email', Auth::user()->email, ['id'=>'email','class' => 'form-control','disabled','required'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-4">
                                <label for="phone">Numero Telefonico:</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    {!! Form::text('phone', Auth::user()->phone, ['id'=>'phone','class' => 'form-control', 'required'])!!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="birthday">Fecha de Nacimiento:</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                    {!! Form::date('birthday',Auth::user()->birthday,['id' => 'birthday','class' => 'form-control','min' => getFechaMinMaxEdad()[1],'max' => getFechaMinMaxEdad()[0], 'required' ]) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="gender">Genero:</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-venus-mars"></i>
                                    </span>
                                    {!! Form::select('gender', ['0' => 'Sin Especificar','1'=>'Hombre','2' => 'Mujer'], Auth::user()->gender , ['id'=>'gender', 'class' => 'form-select','required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-12">
                                {!! Form::submit('Guardar',['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
