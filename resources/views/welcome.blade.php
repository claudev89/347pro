@extends('layouts.app')
@section('content')
    <main class="container">
        @include('includes.carrusel-principal')
        @include('includes.best-sellers')
        @include('includes.bienvenida')
        @include('includes.novedades')
    </main>
    @include('includes.footer')
@endsection
