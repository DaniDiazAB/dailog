<?php
    use App\Models\Amigo;
?>

<?php
                $user_id = auth()->user()->id;

                $textoGusta = "";
                $lista = Amigo::where('user_id_uno', $userDatos->id)
                      ->where('user_id_dos', $user_id)
                      ->first();

                if ($lista) {
                    $textoGusta = "Eliminar amigo";

                } else {
                    $textoGusta = "Añadir amigo";
                }

                if($userDatos->id == $user_id){
                    $textoGusta = "";
                }
        ?>

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
                    <img class="w-48 h-48 rounded-full mx-auto" src="/{{ $userDatos->profile_photo_path }}"> 
                </div>
                <div class="p-6">
                    <h2 class="text-center text-3xl text-gray-900 font-medium leading-8">{{$userDatos->nickname}}</h2> 
    
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

                    <div class="text-center my-6"> 
                        <form action="{{ route('users.amistad', ['userId' => $userDatos->id]) }}" method="post">
                            @csrf
                            <input id="id-user-peticion" type="hidden" name="idUserPeticion" value="{{ $userDatos->id }}">
                
                            <button type="submit" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm text-gray">{{$textoGusta}}</button>
                        </form>
                    </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>