@extends('admin.master')
@section('title','Editar Usuario')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users/all') }}"><i class="fas fa-user-friends"></i> Usuarios</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page_user">
            <div class="row">

                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header d-flex">
                            <h2 class="title w-100"><i class="fas fa-user"></i> Información</h2>
                            <a href="{{ url('/admin/users/all') }}" class="back flex-shrink-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Regresar"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        </div>
                        <div class="inside">
                            <div class="mini_profile">
                                @if(is_null($u->avatar) || $u->avatar == "")
                                    <img src="{{ url('/static/images/Default_Avatar.png') }}" class="avatar">
                                @else
                                <img src="{{ url('/uploads/user/'.$u->id.'/'.$u->avatar) }}" class="avatar">
                                @endif
                                <div class="info">
                                    <span class="title"><i class="far fa-address-card"></i> Nombre: </span>
                                    <span class="text">{{ $u->name }} {{ $u->lastname }}</span>
                                    <span class="title"><i class="fas fa-user-tie"></i> Estado del Usuario: </span>
                                    <span class="text">{{ getUserStatusArray(null,$u->status) }}</span>
                                    <span class="title"><i class="far fa-envelope"></i> Correo Electrónico: </span>
                                    <span class="text">{{ $u->email }}</span>
                                    <span class="title"><i class="far fa-calendar-alt"></i> Fecha De Registro: </span>
                                    <span class="text">{{ $u->created_at }}</span>
                                    <span class="title"><i class="fas fa-user-shield"></i> Rol del Usuario: </span>
                                    <span class="text">{{ getRoleUserArray(null,$u->role) }}</span>
                                </div>
                                @if(kvfj(Auth::user()->permissions,'user_banned'))
                                    @if($u->status == "100")
                                        <a href="{{ url('admin/user/'.$u->id.'/banned') }}" class="btn btn-success"><i class="fas fa-heart"></i> Activar Usuario</a>
                                    @else
                                        <a href="{{ url('admin/user/'.$u->id.'/banned') }}" class="btn btn-danger"><i class="fas fa-heart-broken"></i> Susupender Usuario</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col md-8">
                    <div class="panel shadow">
                        <div class="header d-flex">
                            <h2 class="title w-100-2"><i class="fas fa-user-edit"></i> Editar Información</h2>
                            <a href="{{ url('/admin/user/'.$u->id.'/permissinons') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Permisos de Usuarios" @if(!kvfj(Auth::user()->permissions,'user_permissinons') || $u->role == '0') hidden @endif class="back-link flex-shrink-1"><i class="fas fa-user-cog"></i> Permisos</a>
                        </div>
                        <div class="inside">
                            @if(kvfj(Auth::user()->permissions,'user_edit'))
                                {!! Form::open(['url'=>'/admin/user/'.$u->id.'/edit']) !!}
                                    <div class="row">

                                        <div class="col-md-6">
                                            <label for="modules">Tipo de Usuario:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-text"><i class="fas fa-user-tag"></i></div>
                                                {!! Form::select('user_type', getRoleUserArray('list',null),$u->role , ['id'=>'modules', 'class' => 'form-select']) !!}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mtop16">
                                        <div class="col-md-12 text-center">
                                            {!! Form::submit('Guardar',['class'=>'btn btn-success mtop16']) !!}
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ url('/static/js/user.js?v='.time()) }}"></script>
@endsection
