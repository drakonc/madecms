@extends('admin.master')
@section('title','Usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users/all') }}"><i class="fas fa-user-friends"></i> Usuarios</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-user-friends"></i> Usuarios</h2>
            </div>
            <div class="inside">
                <div class="row">
                    <div class="col-md-2 offset-md-10">
                       <div class="dropdown">
                            <button class="btn btn-my-primary dropdown-toggle" type="button" id="dropdownMenuFiltro" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%">
                                <i class="fas fa-filter"></i> Filtrar
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuFiltro">
                                <a class="dropdown-item" href="{{ url('/admin/users/all') }}"><i class="fas fa-stream"></i> Todos</a>
                                <a class="dropdown-item" href="{{ url('/admin/users/0') }}"><i class="fas fa-unlink"></i> No Verificados</a>
                                <a class="dropdown-item" href="{{ url('/admin/users/1') }}"><i class="fas fa-user-check"></i> Verificados</a>
                                <a class="dropdown-item" href="{{ url('/admin/users/100') }}"><i class="fas fa-heart-broken"></i> Suspendidos</a>
                              </div>
                       </div>
                    </div>
                </div>
                <table class="table table-striped mtop16">
                    <thead >
                        <tr>
                            <td>ID</td>
                            <td></td>
                            <td>Nombre</td>
                            <td>Apellido</td>
                            <td>Email</td>
                            <td>Rol</td>
                            <td>Estado</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td width="50">
                                    @if(is_null($user->avatar) || $user->avatar == "")
                                        <img src="{{ url('/static/images/Default_Avatar.png') }}" class="img-fluid avatar-list">
                                    @else
                                        <img src="{{ url('/uploads_users/'.$user->id.'/'.$user->avatar) }}" class="img-fluid avatar-list">
                                    @endif
                                </td>
                                <td class="center">{{$user->name}}</td>
                                <td class="center">{{$user->lastname}}</td>
                                <td class="center">{{$user->email}}</td>
                                <td class="center">{{getRoleUserArray(null,$user->role)}}</td>
                                <td class="center">{{getUserStatusArray(null,$user->status)}}</td>
                                <td>
                                    <div class="opts">
                                        <a href="{{ url('/admin/user/'.$user->id.'/edit') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" @if(!kvfj(Auth::user()->permissions,'user_edit')) hidden @endif><i class="fas fa-edit"></i></a>
                                        <a href="{{ url('/admin/user/'.$user->id.'/permissinons') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Permisos de Usuarios" @if(!kvfj(Auth::user()->permissions,'user_permissinons') || $user->role == '0') hidden @endif><i class="fas fa-user-cog"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mtop16">
                    {!! $users->links('common.pagination') !!}
                </div>
            </div>
        </div>
    </div>
@endsection

