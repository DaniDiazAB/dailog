<?php
    use App\Models\Lista;
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mi Feed') }}
        </h2>
    </x-slot>

     <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-gray-50 py-8 pb-4">

        @if($posts == "")
            <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
                No tienes publicaciones de amigos.
            </h2>
        @endif

        @foreach ($posts as $post)
                    
            @php
                $user_id = auth()->user()->id;

                $lista = Lista::where('user_id', $user_id)
                            ->where('id_post', $post->id)
                            ->where('id_tipo', 3)
                            ->first();

                $textoGusta = $lista ? "Ya no me gusta" : "Me gusta";

                $lista2 = Lista::where('user_id', $user_id)
                            ->where('id_post', $post->id)
                            ->where('id_tipo', 2)
                            ->first();

                $textoTarde = $lista2 ? "Ya lo he leído" : "Leer más tarde";

                $lista3 = Lista::where('user_id', $user_id)
                            ->where('id_post', $post->id)
                            ->where('id_tipo', 1)
                            ->first();

                $textoFavoritos = $lista3 ? "Quitar de favoritos" : "Favorito";
            @endphp

            <article class="border border-gray-200 shadow-lg rounded-lg p-6 mb-6">
                <div class="mb-4">
                    

                    <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
                        {{ $post->titulo }}
                    </h2>

                    <h2 class="text-3xl font-semibold text-gray-800 leading-tight">
                        Creado por:  <a href="users/profile/{{ $post->user_id }}"> {{ $post->nickname }} </a> - {{ $post->created_at}}
                    </h2>

                    <h2 class="text-3xl font-semibold text-gray-800 leading-tight">
                        <a href="categoria/{{ $post->categoria }}"> Categoria: {{ $post->categoria }} </a>
                    </h2>
                
                    <p class="text-justify text-gray-600">
                        {{ $post->contenido }}
                    </p>

                    <p class="text-justify text-gray-600">
                        <img src="{{ asset('storage/' . $post->imagen) }}" class="w-full" alt="">
                    </p>

                    <div class="flex justify-end">
                        <div class="px-6 pt-4 pb-2">
                            <form action="{{ route('lista.store', ['postId' => 1]) }}" method="post">
                                @csrf
                                <input id="1" type="hidden" name="id" value="{{ $post->id }}">
                                <input type="hidden" name="idTipo" value="3">
                    
                                <button type="submit" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm text-gray">{{ $textoGusta }}</button>
                            </form>
                        </div>
                    
                        <div class="px-6 pt-4 pb-2">
                            <form action="{{ route('lista.store', ['postId' => 2]) }}" method="post">
                                @csrf
                                <input id="2" type="hidden" name="id" value="{{ $post->id }}">
                                <input type="hidden" name="idTipo" value="2">
                    
                                <button type="submit" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm text-gray">{{ $textoTarde }}</button>
                            </form>
                        </div>
                    
                        <div class="px-6 pt-4 pb-2">
                            <form action="{{ route('lista.store', ['postId' => 3]) }}" method="post">
                                @csrf
                                <input id="3" type="hidden" name="id" value="{{ $post->id }}">
                                <input type="hidden" name="idTipo" value="1">
                    
                                <button type="submit" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm text-gray">{{ $textoFavoritos }}</button>
                            </form>
                        </div>
                    </div>
                    

                </div>
            </article> 
        @endforeach
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>

</x-app-layout>