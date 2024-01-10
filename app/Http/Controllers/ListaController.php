<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use App\Models\Post;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListaController extends Controller
{
    public function tipo(Tipo $tipo){
        $user_id = auth()->user()->id;
        $lista_id = $tipo->id;
        $posts = Post::join('listas', 'posts.id', '=', 'listas.id_post')
            ->where('listas.id_tipo', $tipo->id)
            ->where('listas.user_id', $user_id) 
            ->select('posts.*')
            ->orderBy('posts.id', 'desc') 
            ->paginate(5);  
        return view('posts.tipo', compact('posts', 'tipo'));
    }

    public function agregarLista(Request $request){
        $user_id = auth()->user()->id;
        $idPost = intval($request->id);
        $idTipo = intval($request->idTipo);

        $lista = Lista::where('user_id', $user_id)
                      ->where('id_post', $idPost)
                      ->where('id_tipo', $idTipo)
                      ->first();
    
        if ($lista) {
            $lista->delete();
        } else {
            $nuevaLista = new Lista();
            $nuevaLista->user_id = $user_id;
            $nuevaLista->id_post = $request->id;
            $nuevaLista->id_tipo = $request->idTipo;
            $nuevaLista->save();
        }
        return redirect()->back()->with('success');

    }

    



}


