@extends('admin.master')
@section('title','Configuraciones')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/settings') }}"><i class="fas fa-cogs"></i> Configuraciones</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-cogs"></i> Confguraciones</h2>
            </div>
            <div class="inside">
                {!! Form::open(['url' => '/admin/settings']) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Nombre de la Tienda:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                {!! Form::text('name', Config::get('madecms.name'), ['id'=>'name','class' => 'form-control'])!!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="currency">Moneda:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-hand-holding-usd"></i></span>
                                {!! Form::text('currency', Config::get('madecms.currency'), ['id'=>'currency','class' => 'form-control'])!!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="company_phone">Telefono:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                {!! Form::text('company_phone', Config::get('madecms.company_phone'), ['id'=>'company_phone','class' => 'form-control'])!!}
                            </div>
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-4">
                            <label for="map">Ubicaciones:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                {!! Form::text('map', Config::get('madecms.map'), ['id'=>'map','class' => 'form-control'])!!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="mantenimiento_mode">Modo Mantenimiento:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-ban"></i></span>
                                {!! Form::select('mantenimiento_mode', ['0' => 'Desactivado','1'=>'Activo'], Config::get('madecms.mantenimiento_mode') , ['id'=>'mantenimiento_mode', 'class' => 'form-select','placeholder' => 'Seleccione una Opción']) !!}
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="row">
                        <div class="col-md-4">
                            <label for="products_per_page">Productos a Mostrar Por Pagina:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                {!! Form::number('products_per_page' ,Config::get('madecms.products_per_page'), ['id'=>'products_per_page','class' => 'form-control', 'min'=> 1, 'required'])!!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="products_per_page_random">Productos a Mostrar Por Pagina (Random):</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="far fa-keyboard"></i></span>
                                {!! Form::number('products_per_page_random' ,Config::get('madecms.products_per_page_random'), ['id'=>'products_per_page_random','class' => 'form-control', 'min'=> 1, 'required'])!!}
                            </div>
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-12 text-end">
                            {!! Form::submit('Guardar',['class'=>'btn btn-success']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
