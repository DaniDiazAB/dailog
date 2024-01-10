<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear nueva publicación') }}
        </h2>
    </x-slot>
    
    <form action="{{ route('posts.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-gray-50 py-8 pb-4">
            <h2 class="text-2xl font-semibold mb-4">Crear nueva publicación</h2>

            <div class="mb-4">
                <label for="titulo" class="block text-sm font-medium text-gray-600">Título (max 50 caracteres)</label>
                <input type="text" id="titulo" name="titulo" maxlength="50" class="mt-1 p-2 w-full border rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="contenido" class="block text-sm font-medium text-gray-600">Contenido</label>
                <textarea id="contenido" name="contenido" rows="4" class="mt-1 p-2 w-full border rounded-md" required></textarea>
            </div>

            <div class="mb-4">
                <label for="categoria" class="block text-sm font-medium text-gray-600">Categoría (max 20 caracteres)</label>
                <input type="text" id="categoria" name="categoria" maxlength="20" class="mt-1 p-2 w-full border rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" id="imagen" accept="image/*">
            </div>
            
        
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 border border-blue-700 rounded">Publicar</button>            
            </div>
              
        </div>
    </form>

</x-app-layout>