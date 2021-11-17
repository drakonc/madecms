@extends('master')
@section('title','Inicio')
@section('content')

    <section>
        <div class="home_action_bar shadow">
            <div class="row">
                <div class="col-md-3">
                    <div class="categories">
                        <a href="#"><i class="fas fa-stream"></i> Categorias</a>
                        <ul class="shadow">
                            @foreach ($categories as $cat)
                            <li>
                                <a href="{{ url('/store/category/'.$cat->id.'/'.$cat->slug) }}">
                                    <img src="{{ url('/uploads/'.$cat->file_path.'/'.$cat->icono) }}" alt="No Hay Imagen" class="img-fluid">
                                    {{ $cat->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-md-9">
                    {!! Form::open(['url' =>'/search']) !!}
                    <div class="input-group">
                        <i class="fas fa-search"></i>
                        {!! Form::text('search_query',null, ['id'=>'search_query','class' => 'form-control', 'placeholder' => '¿Buscas Algo?', 'required'])!!}
                        {!! Form::submit('Guardar',['id' =>'Guardar', 'class'=>'btn']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>

    <section>
        @include('components/slider_home')
    </section>

    <section>
        <div class="container pt-5">
            <div class="products_list" id="products_list">

            </div>
        </div>
    </section>

@endsection
