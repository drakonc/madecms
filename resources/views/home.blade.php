@extends('master')
@section('title','Inicio')
@section('content')

    <div class="home_action_bar">
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
        </div>
    </div>

@endsection
