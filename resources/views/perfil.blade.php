@extends('layouts.app')
@section('titulo', 'Perfil de usuario')
@section('content')
    <main class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fw-bold mb-3">
                <li class="breadcrumb-item"><a href="/" class="text-reset" style="text-decoration: none">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Perfil</li>
            </ol>
        </nav>
        @livewire('perfil')
    </main>

    @include('includes.footer')
@endsection
