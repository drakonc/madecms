@extends('admin.master')
@section('title','Categorias')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/sliders') }}"><i class="fas fa-images"></i> Sliders</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/slider/'.$slider->id.'/edit') }}"><i class="fas fa-images"></i>Editar Slide {{$slider->id}}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 offset-md-1">
                <div class="panel shadow">
                    <div class="header d-flex">
                        <h2 class="title w-100"><i class="fas fa-edit"></i> Editar Slide</h2>
                        <a href="{{ url('/admin/sliders') }}" class="back flex-shrink-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Regresar"><i class="fas fa-arrow-alt-circle-left"></i></a>
                    </div>
                    <div class="inside">
                        {!! Form::open(['url'=>'/admin/slider/'.$slider->id.'/edit','autocomplete' => 'off'])!!}

                            <label for="name">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', $slider->name, ['id'=>'name','class' => 'form-control','required'])!!}
                            </div>

                            <label for="visible" class="mtop16">Visible:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-layer-group"></i>
                                </span>
                                {!! Form::select('visible', ['0' =>'No Visible', '1' =>'Visible'], $slider->status , ['id'=>'visible', 'class' => 'form-select']) !!}
                            </div>
                                
                            <label for="content" class="mtop16">Contenido:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::textarea('content', htmlspecialchars_decode($slider->content), ['id'=>'content','class' => 'form-control', 'rows' => '3', 'required'])!!}
                            </div>

                            <label for="order" class="mtop16">Orden Aparición:</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::number('order', $slider->sorder, ['id'=>'order','class' => 'form-control', 'min' => '0' , 'required'])!!}
                            </div>

                            {!! Form::submit('Guardar',['class'=>'btn btn-success mtop16']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="panel shadow">
                    <div class="header d-flex">
                        <h2 class="title w-100"><i class="fas fa-edit"></i> Imagen Slide</h2>
                    </div>
                    <div class="inside">
                        <div class="text-center">
                            <img src="{{ url('/uploads/'.$slider->file_path.'/'.$slider->file_name) }}" class="img-fluid" alt="No Imagen">
                        </div>
                    </div>
                </div>
            </div>
 
        </div>
    </div>
@endsection

