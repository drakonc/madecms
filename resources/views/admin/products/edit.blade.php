@extends('admin.master')
@section('title','Editar Producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products/'.$product->status) }}"><i class="fas fa-boxes"></i> Productos</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/'.$product->id.'/edit') }}"><i class="fas fa-edit"></i> Editar Producto</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header d-flex">
                        <h2 class="title w-100"><i class="fas fa-edit"></i> Editar Producto</h2>
                        @if(is_null($product->deleted_at))
                            <a href="{{ url('/admin/products/'.$product->status) }}" class="back flex-shrink-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Regresar"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        @else
                            <a href="{{ url('/admin/products/trash') }}" class="back flex-shrink-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Regresar"><i class="fas fa-arrow-alt-circle-left"></i></a>
                        @endif
                    </div>
                    <div class="inside">

                        {!! Form::open(['url'=>'/admin/product/'.$product->id.'/edit','files' => true ]) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Nombre del Producto:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                        {!! Form::text('name', $product->name, ['id'=>'name','class' => 'form-control','required'])!!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="category">Categoría:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                        {!! Form::select('category', $cats, $product->category_id , ['id'=>'category', 'class' => 'custom-select form-control','placeholder' => 'Seleccione una Opción','required']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="customFile">Imagen Destacada:</label>
                                    <div class="input-group">
                                        {!! Form::file('img',['id'=>'customFile','class' => 'form-control', 'accept'=>'image/*']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row mtop16">
                                <div class="col-md-3">
                                    <label for="price">Precio:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        {!! Form::number('price', $product->price, ['id'=>'price', 'class' => 'form-control', 'min'=>'0.00', 'step'=>'any','required'])!!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="indiscount">¿En Descuento?:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        {!! Form::select('indiscount', ['0' => 'No','1'=>'Si'], $product->in_discount , ['id'=>'indiscount', 'class' => 'form-select','placeholder' => 'Seleccione una Opción','required']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="discount">Descuento:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        {!! Form::number('discount',$product->discount, ['id'=>'discount', 'class' => 'form-control', 'min'=>'0.00', 'step'=>'any'])!!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="inventory">Inventario:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-pallet"></i></span>
                                        {!! Form::number('inventory',  $product->inventory, ['id'=>'inventory', 'class' => 'form-control', 'min'=>'0'])!!}
                                    </div>
                                </div>

                            </div>

                            <div class="row mtop16">
                                <div class="col-md-3">
                                    <label for="code">Codío de SIstema:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fab fa-codepen"></i></span>
                                        {!! Form::text('code',  $product->code, ['id'=>'code', 'class' => 'form-control', 'min'=>'0'])!!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="status">Estado:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                        {!! Form::select('status', ['0' => 'Borrador','1' => 'Publico'], $product->status , ['id'=>'status', 'class' => 'form-select','placeholder' => 'Seleccione una Opción','required']) !!}
                                    </div>
                                </div>

                            </div>

                            <div class="row mtop16">
                                <div class="col-md-12">
                                    <label for="content">Descripción</label>
                                    {!! Form::textarea('content',$product->content,['class'=>'form-control','id'=>'content']) !!}
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
                        <a id="imga" href="{{ url('/uploads/'.$product->file_path.'/'.$product->image) }}" data-fancybox="gallery">
                            <img id="img" src="{{ url('/uploads/'.$product->file_path.'/'.$product->image) }}" alt="No Imagen" class="img-fluid rounded">
                        </a>
                    </div>
                </div>

                <div class="panel shadow mtop16">
                    <div class="header d-flex">
                        <h2 class="title mr-auto"><i class="fas fa-images"></i> Galeria</h2>
                    </div>
                    <div class="inside product_gallery">
                        {!! Form::open(['url'=>'/admin/product/'.$product->id.'/galery/add','files' => true, 'id' => 'form_product_gallery' ]) !!}
                        {!! Form::file('file_image',['id'=>'product_file_image','accept'=>'image/*','style' => 'display: none;', 'required']) !!}
                        {!! Form::close() !!}

                        <div class="btn-submit" @if(!kvfj(Auth::user()->permissions,'product_galery_add')) hidden @endif>
                            <a id="btn_product_file_image"><i class="fas fa-plus"></i></a>
                        </div>

                        <div class="tumbs">
                            @foreach ($product->getGallery as $img)
                                <div class="tumb mtop16">
                                    <a @if(!kvfj(Auth::user()->permissions,'product_galery_delete')) hidden @endif href="{{ url('/admin/product/'.$product->id.'/galery/'.$img->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn-del" onclick="return confirm('Esta Seguro de Eliminar el Registro?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <a href="{{ url('/uploads/'.$img->file_path.'/'.$img->file_name) }}" data-fancybox="gallery">
                                        <img id="img" src="{{ url('/uploads/'.$img->file_path.'/t_'.$img->file_name) }}" alt="No Imagen" class="img-fluid rounded">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ url('/static/js/products.js?v='.time()) }}"></script>
@endsection

