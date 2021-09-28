@extends('admin.master')
@section('title','Modulo de Slider')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/sliders') }}"><i class="fas fa-images"></i> Sliders</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                @if(kvfj(Auth::user()->permissions,'slider_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus"></i> Agregar Slide</h2>
                        </div>
                    <div class="inside">
                            {!! Form::open(['url'=>'/admin/slider/add','files' => true,'autocomplete' => 'off'])!!}

                                <label for="name">Nombre:</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                    {!! Form::text('name', null, ['id'=>'name','class' => 'form-control', 'required'])!!}
                                </div>

                                <label for="visible" class="mtop16">Visible:</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-layer-group"></i>
                                    </span>
                                    {!! Form::select('visible', ['0' =>'No Visible', '1' =>'Visible'], 1 , ['id'=>'visible', 'class' => 'form-select']) !!}
                                </div>

                                <label for="img" class="mtop16">Imagen Destacada:</label>
                                <div class="input-group">
                                    {!! Form::file('img',['id'=>'img','class' => 'form-control', 'accept'=>'image/*', 'required' ]) !!}
                                </div>
                                
                                <label for="content" class="mtop16">Contenido:</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                    {!! Form::textarea('content', null, ['id'=>'content','class' => 'form-control', 'rows' => '3', 'required'])!!}
                                </div>

                                <label for="order" class="mtop16">Orden Aparición:</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                    {!! Form::number('order', 0, ['id'=>'order','class' => 'form-control', 'min' => '0', 'required'])!!}
                                </div>

                                {!! Form::submit('Guardar',['class'=>'btn btn-success mtop16']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>
             
            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="far fa-folder-open"></i> Sliders</h2>
                    </div>
                    <div class="inside">
                        <table class="table table-striped mtop16">
                            <thead>
                                <tr>
                                    <td width="180"></td>
                                    <td></td>
                                    <td width="120"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $sd)
                                    <tr>
                                        <td>
                                            <a href="{{ url('/uploads/'.$sd->file_path.'/'.$sd->file_name) }}" data-fancybox="gallery">
                                                <img src="{{ url('/uploads/'.$sd->file_path.'/'.$sd->file_name) }}" alt="No Imagen" class="img-fluid">
                                            </a>
                                        </td>
                                        <td>
                                             <div class="slider_content">
                                                <h1>{{ $sd->name }}</h1>
                                                {!! htmlspecialchars_decode($sd->content) !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="opts">
                                                <a href="{{ url('/admin/slider/'.$sd->id.'/edit') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" @if(!kvfj(Auth::user()->permissions,'slider_edit')) hidden @endif><i class="fas fa-edit"></i></a>
                                                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar" class="text-danger btn-confirm" data-object={{ $sd->id}} data-path="admin/slider" data-action="delete"  @if(!kvfj(Auth::user()->permissions,'slider_delete')) hidden @endif><i class="fas fa-trash-alt"></i></a>
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
@section('script')
    <script src="{{ url('/static/js/slider.js?v='.time()) }}"></script>
@endsection