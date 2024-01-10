<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Perfil del usuario: ' . $userDatos->nickname) }}
        </h2>
    </x-slot>

    <div class="flex items-center h-screen w-full justify-center mt-8"> 
        <div class="max-w-2xl">
            <div class="bg-white shadow-xl rounded-lg p-6">
                <div class="photo-wrapper p-6"> 
                    <img class="w-48 h-48 rounded-full mx-auto" src="storage/{{ $userDatos->profile_photo_path }}"> 
                </div>
                <div class="p-6">
                    <h1 class="text-center text-2xl text-gray-900 font-medium leading-8">{{$userDatos->nickname}}</h1>
    
                    <table class="text-base my-6">
                        <tbody>
                            <tr>
                                <td class="px-4 py-3 text-gray-500 font-semibold">Nombre:</td> 
                                <td class="px-4 py-3">{{$userDatos->name}}</td>
                            </tr>

                            <tr>
                                <td class="px-4 py-3 text-gray-500 font-semibold">Biografia: </td>
                                <td class="px-4 py-3">{{$userDatos->biografia}}</td>
                            </tr>

                            <tr>
                                <td class="px-4 py-3 text-gray-500 font-semibold">Total de publicaciones: </td>
                                <td class="px-4 py-3">{{$totalPosts}}</td>
                            </tr>
                        </tbody>
                    </table>
    
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>