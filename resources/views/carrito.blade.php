@extends('layouts.app')
@php
    $cantidadDeArticulos = 0;
    if(auth()->check() && auth()->user()->getCarrito())
        {
            $cantidadDeArticulos = collect(auth()->user()->getCarrito())->sum('cantidad') ?? 0;
        } else {
        $cantidadDeArticulos = collect(session()->get('carrito', []))->map(function ($item) {
                return is_array($item) ? (object) $item : $item;
            })->sum('cantidad');
        }
@endphp
@section('titulo', 'Carrito (' . $cantidadDeArticulos . ')')
@section('content')
    <main class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fw-bold">
                <li class="breadcrumb-item"><a href="/" class="text-reset" style="text-decoration: none">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Carrito de compras</li>
            </ol>
        </nav>
        @livewire('carrito')
    </main>

    @include('includes.footer')
@endsection
