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
            <div class="col-md-3 @if(is_null($cat->icono)) offset-md-4 @else offset-md-3 @endif">
                <div class="panel shadow">
                    <div class="header d-flex">
                        <h2 class="title w-100"><i class="fas fa-edit"></i> Editar Categorias</h2>
                        <a href="{{ url('/admin/categories/'.$cat->module) }}" class="back flex-shrink-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Regresar"><i class="fas fa-arrow-alt-circle-left"></i></a>
                    </div>
                    <div class="inside">
                        {!! Form::open(['url'=>'/admin/category/'.$cat->id.'/edit','files' => true,'autocomplete' => 'off']) !!}

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
                                {!! Form::file('icon',['id'=>'icon','class' => 'form-control', 'accept'=>'image/*']) !!}
                            </div>

                            {!! Form::submit('Guardar',['class'=>'btn btn-success mtop16']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            @if(!is_null($cat->icono))
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header d-flex">
                        <h2 class="title w-100"><i class="fas fa-edit"></i> Icono Categorias</h2>
                    </div>
                    <div class="inside">
                        <div class="text-center">
                            <img src="{{ url('/uploads/'.$cat->file_path.'/'.$cat->icono) }}" class="img-fluid" alt="No Imagen">
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

