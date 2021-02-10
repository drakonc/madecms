@extends('admin.master')
@section('title','Agregar Producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}"><i class="fas fa-boxes"></i> Productos</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/add') }}"><i class="fas fa-plus"></i> Agregar Producto</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header d-flex">
                        <h2 class="title w-100"><i class="fas fa-plus"></i> Agregar Producto</h2>
                        <a href="{{ url('/admin/products/all') }}" class="back flex-shrink-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Regresar"><i class="fas fa-arrow-alt-circle-left"></i></a>
                    </div>
                    <div class="inside">

                        {!! Form::open(['url'=>'/admin/product/add','files' => true ]) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Nombre del Producto:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                        {!! Form::text('name', null, ['id'=>'name','class' => 'form-control','required'])!!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="category">Categoría:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                        {!! Form::select('category', $cats, null , ['id'=>'category', 'class' => 'form-select','placeholder' => 'Seleccione una Opción','required']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="customFile">Imagen Destacada:</label>
                                    <div class="input-group">
                                        {!! Form::file('img',['id'=>'customFile','class' => 'form-control', 'accept'=>'image/*' ,'required']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row mtop16">
                                <div class="col-md-3">
                                    <label for="price">Precio:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        {!! Form::number('price', null, ['id'=>'price', 'class' => 'form-control', 'min'=>'0.00', 'step'=>'any','required'])!!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="indiscount">¿En Descuento?:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        {!! Form::select('indiscount', ['0' => 'No','1'=>'Si'], null , ['id'=>'indiscount', 'class' => 'form-select','placeholder' => 'Seleccione una Opción','required']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="discount">Descuento:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        {!! Form::number('discount', 0.00, ['id'=>'discount', 'class' => 'form-control', 'min'=>'0.00', 'step'=>'any'])!!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="inventory">Inventario:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-pallet"></i></span>
                                        {!! Form::number('inventory', 0, ['id'=>'inventory', 'class' => 'form-control', 'min'=>'0'])!!}
                                    </div>
                                </div>

                            </div>

                            <div class="row mtop16">
                                <div class="col-md-3">
                                    <label for="code">Codío de SIstema:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-codepen"></i></span>
                                        {!! Form::text('code', 0, ['id'=>'code', 'class' => 'form-control', 'min'=>'0'])!!}
                                    </div>
                                </div>
                            </div>

                            <div class="row mtop16">
                                <div class="col-md-12">
                                    <label for="content">Descripción</label>
                                    {!! Form::textarea('content',null,['class'=>'form-control','id'=>'content']) !!}
                                </div>
                            </div>

                            <div class="row mtop16">
                                <div class="col-md-12">
                                    {!! Form::submit('Guardar',['class'=>'btn btn-success']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>

            <div class="col-md-3">

                <div class="panel shadow">
                    <div class="header d-flex">
                        <h2 class="title mr-auto"><i class="fas fa-image"></i> Imagen Destacada</h2>
                    </div>
                    <div class="inside">
                        <img id="img" src="{{ url('/static/images/imgMuestra.png') }}" alt="No Imagen" class="img-fluid rounded">
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ url('/static/js/products.js?v='.time()) }}"></script>
@endsection

