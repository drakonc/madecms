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
            <div class="col-md-3 offset-md-4">
                <div class="panel shadow">
                    <div class="header d-flex">
                        <h2 class="title w-100"><i class="fas fa-edit"></i> Editar Categorias</h2>
                        <a href="{{ url('/admin/categories/'.$cat->module) }}" class="back flex-shrink-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Regresar"><i class="fas fa-arrow-alt-circle-left"></i></a>
                    </div>
                    <div class="inside">
                        {!! Form::open(['url'=>'/admin/category/'.$cat->id.'/edit']) !!}

                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', $cat->name, ['id'=>'name','class' => 'form-control'])!!}
                            </div>

                            <label for="modules" class="mtop16">Módulo:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-layer-group"></i>
                                </span>
                                {!! Form::select('modules', getModulesArray(),$cat->module , ['id'=>'modules', 'class' => 'form-select']) !!}
                            </div>

                            <label for="icon" class="mtop16">Ícono:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-icons"></i>
                                </span>
                                {!! Form::text('icon', $cat->icono, ['id'=>'icon','class' => 'form-control'])!!}
                            </div>

                            {!! Form::submit('Guardar',['class'=>'btn btn-success mtop16']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

