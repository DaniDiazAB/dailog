<?php
    use App\Models\Lista;
?>
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mis publicaciones</h1>
@stop

@section('content')


    @foreach ($posts as $post)
        <article class="border border-gray-200 shadow-lg rounded-lg p-6 mb-3">
                <h1 class="text-2xl font-semibold text-gray-800 leading-tight">
                    {{ $post->titulo }}
                </h1>

                <h4 leading-tight">
                    <a href="/categoria/{{ $post->categoria }}"> Categoria: {{ $post->categoria }} </a>
                </h4>
                    
                <p class="text-justify text-gray-600">
                    {{ $post->contenido }}
                </p>

                <p class="text-justify text-gray-600">
                    <img src="{{ asset('storage/' . $post->imagen) }}" alt="">
                </p>
                <button type="submit" class="inline-block bg-red rounded-full px-3 py-1 text-sm">Eliminar publicación</button>
        </article> 
        <br>
    @endforeach

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
