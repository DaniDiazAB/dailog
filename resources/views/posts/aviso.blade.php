<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear nueva publicación') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-gray-50 py-8 pb-4">
        <h1>
            YA HAS PUBLICADO HOY.
        </h1>
        De todas formas te dejamos lo que has escrito para que no lo pierdas:<br>
        <p><h2>Titulo:</h2>
        {{$post->titulo}}</p><br>

        <p><h2>Contenido:</h2>
        {{$post->contenido}}</p><br>

        <p><h2>Categoria</h2>
        {{$post->categoria}}</p><br>

        <p><h2>Imagen:</h2>
        {{$post->imagen}}</p><br>
    </div>


</x-app-layout>