@extends('admin.master')
@section('title','Productos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}"><i class="fas fa-boxes"></i> Productos</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-boxes"></i> Productos</h2>
                <ul>
                    <li @if(!kvfj(Auth::user()->permissions,'product_add')) hidden @endif>
                        <a href="{{  url('/admin/product/add') }}">
                            <i class="fas fa-plus"></i> Agregar Producto
                        </a>
                    </li>
                    <li id="sbfilter">
                        <a href="#">Filtrar <i class="fas fa-chevron-down"></i></a>
                        <ul class="shadow">
                            <li> <a href="{{url('/admin/products/all') }}"><i class="fas fa-list-ul"></i> Todos</a></li>
                            <li> <a href="{{url('/admin/products/1') }}"><i class="fas fa-globe-americas"></i> Públicos</a></li>
                            <li> <a href="{{url('/admin/products/0') }}"><i class="fas fa-eraser"></i> Borrador</a></li>
                            <li> <a href="{{url('/admin/products/trash') }}"><i class="fas fa-trash"></i> Papelera</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" id="btn_search"><i class="fas fa-search"></i> Buscar</a>
                    </li>
                </ul>
            </div>
            <div class="inside">

                <div class="form_search" id="form_search">
                    {!! Form::open(['url'=>'/admin/product/search']) !!}
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::text('search', null, ['id'=>'search', 'class' => 'form-control','placeholder' => 'Ingrese su Busqueda','required'])!!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::select('filter', ['0' => 'Nombre del Producto','1'=>'Código'], null, ['id'=>'filter', 'class' => 'form-select','placeholder' => 'Seleccione una Opción','required']) !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::select('status', ['0' => 'Borrador','1' => 'Público'], null, ['id'=>'status', 'class' => 'form-select','placeholder' => 'Seleccione una Opción']) !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::submit('Buscar',['class'=>'btn btn-my-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td width="50">ID</td>
                            <td width="64"></td>
                            <td>Nombre</td>
                            <td>Categoria</td>
                            <td>Precio</td>
                            <td width="120"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $p)
                            <tr>
                                <td width="50">{{ $p->id }}</td>
                                <td width="64">
                                    <a href="{{ url('/uploads/'.$p->file_path.'/'.$p->image) }}" data-fancybox="gallery">
                                        <img src="{{ url('/uploads/'.$p->file_path.'/t_'.$p->image) }}" alt="No Imagen" width="64">
                                    </a>
                                </td>
                                <td>{{ $p->name }} @if($p->status == "0") <i class="fas fa-eraser" data-toggle="tooltip" data-placement="top" title="Estado: Borrador"></i>  @endif</td>
                                <td>{!! htmlspecialchars_decode($p->cat->icono) !!} {{ $p->cat->name }}</td>
                                <td>{{ $p->price }}</td>
                                <td>
                                    @if(is_null($p->deleted_at))
                                        <div class="opts">
                                            <a href="{{ url('/admin/product/'.$p->id.'/edit') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" @if(!kvfj(Auth::user()->permissions,'product_edit')) hidden @endif><i class="fas fa-edit"></i></a>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar" class="text-danger btn-confirm" data-object={{ $p->id}} data-path="admin/product" data-action="delete"  @if(!kvfj(Auth::user()->permissions,'product_delete')) hidden @endif><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    @else
                                    <div class="opts">
                                        <a  data-bs-toggle="tooltip" data-bs-placement="top" title="Restaurar" class="text-danger btn-confirm" data-object={{ $p->id}} data-path="admin/product" data-action="restore" @if(!kvfj(Auth::user()->permissions,'product_restore')) hidden @endif><i class="fas fa-trash-restore-alt"></i></a>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mtop16">
                    {!! $products->links('common.pagination') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ url('/static/js/products.js?v='.time()) }}"></script>
@endsection
