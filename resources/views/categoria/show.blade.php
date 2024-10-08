@extends('layouts.app')
@section('content')
    <main class="container">
        <div>
            @if($subcategoria)
                Hola, soy la subcategoría: {{ $subcategoria->nombre }}
            @else
                Hola, soy la categoría: {{ $categoria->nombre }}
            @endif
        </div>
    </main>
    @include('includes.footer')
@endsection
