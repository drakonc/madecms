@extends('admin.master')
@section('title','Categorias')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/categories/0') }}"><i class="far fa-folder-open"></i> Categorias</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i> Agregar Categorias</h2>
                    </div>
                    <div class="inside">
                        @if(kvfj(Auth::user()->permissions,'category_add'))
                            {!! Form::open(['url'=>'/admin/category/add']) !!}

                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                    {!! Form::text('name', null, ['id'=>'name','class' => 'form-control'])!!}
                                </div>

                                <label for="modules" class="mtop16">Módulo:</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-layer-group"></i>
                                    </span>
                                    {!! Form::select('modules', getModulesArray(), 0 , ['id'=>'modules', 'class' => 'form-select']) !!}
                                </div>

                                <label for="icon" class="mtop16">Ícono:</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-icons"></i>
                                    </span>
                                    {!! Form::text('icon', null, ['id'=>'icon','class' => 'form-control'])!!}
                                </div>

                                {!! Form::submit('Guardar',['class'=>'btn btn-success mtop16']) !!}

                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="far fa-folder-open"></i> Categorias</h2>
                    </div>
                    <div class="inside">
                        <nav class="nav nav-pills nav-fill">
                            @foreach (getModulesArray() as $m => $k)
                                <a class="nav-link" href="{{ url('/admin/categories/'.$m) }}"><i class="fas fa-list"></i> {{ $k }}</a>
                            @endforeach
                        </nav>
                        <table class="table table-striped mtop16">
                            <thead>
                                <tr>
                                    <td width="32"></td>
                                    <td>Nombre</td>
                                    <td width="120"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cats as $cat)
                                    <tr>
                                        <td>{!! htmlspecialchars_decode($cat->icono) !!}</td>
                                        <td>{{ $cat->name }}</td>
                                        <td>
                                            <div class="opts">
                                                <a href="{{ url('/admin/category/'.$cat->id.'/edit') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" @if(!kvfj(Auth::user()->permissions,'category_edit')) hidden @endif><i class="fas fa-edit"></i></a>
                                                <a href="{{ url('/admin/category/'.$cat->id.'/delete') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar" class="text-danger" onclick="return confirm('Esta Seguro de Eliminar el Registro?')" @if(!kvfj(Auth::user()->permissions,'category_delete')) hidden @endif><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

