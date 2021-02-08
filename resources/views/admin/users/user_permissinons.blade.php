@extends('admin.master')
@section('title','Permisos de Usuario')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users/all') }}"><i class="fas fa-user-friends"></i> Usuarios</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/user/'.$u->id.'/edit') }}"><i class="fas fa-user-cog"></i> Editar Usuario</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/user/'.$u->id.'/permissinons') }}"><i class="fas fa-user-cog"></i> Permisos de Usuario: {{ $u->name }} {{ $u->lastname }} (ID: {{ $u->id }})</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page_user">
            <form action="{{ url('/admin/user/'.$u->id.'/permissinons') }}" method="POST">
                @csrf
                <div class="row">
                    @foreach (user_permissions() as $key => $value)
                        <div class="col-md-4 d-flex mbottom16">
                            <div class="panel shadow">
                                <div class="header d-flex">
                                    <h2 class="title mr-auto">{!! $value['icon'] !!} {{ $value['title'] }}</h2>
                                </div>
                                <div class="inside">
                                    @foreach ($value['key'] as $k => $v)
                                        <div class="form-check form-switch">
                                            <input type="checkbox" value="true" name="{{ $k }}" id="{{ $k }}" class="form-check-input" id="{{ $k }}" @if(kvfj($u->permissions,$k)) checked @endif>
                                            <label for="{{ $k }}" class="form-check-label">{{ $v }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel shadow">
                            <div class="inside">
                                <input type="submit" value="Guardar" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ url('/static/js/permissinons.js?v='.time()) }}"></script>
@endsection
