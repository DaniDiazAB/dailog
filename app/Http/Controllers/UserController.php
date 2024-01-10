<?php

namespace App\Http\Controllers;

use App\Models\Amigo;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $posts = User::where('is_perfil_publico', 1)->with('posts')->get();
        return view('posts.index', compact('posts'));
    }

    public function show($id){
        $user = DB::table('users')
                ->select('users.id', 'users.name', DB::raw('COUNT(posts.id) as total_posts'))
                ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
                ->where('users.id', '=', $id)
                ->groupBy('users.id', 'users.name') 
                ->first();

        $userDatos = User::where('id', $id)->first();
        $totalPosts = Post::where('user_id', $id)->count();

        return view('users.profile',compact('userDatos','user','totalPosts'));
    }

    public function getId(){
        $id = auth()->id();

        $user = DB::table('users')
        ->select('users.id', 'users.name', DB::raw('COUNT(posts.id) as total_posts'))
        ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
        ->where('users.id', '=', $id)
        ->groupBy('users.id', 'users.name') 
        ->first();

        $userDatos = User::where('id', $id)->first();

        $totalPosts = Post::where('user_id', $id)->count();

        
        return view('users.miperfil',compact('userDatos','user','totalPosts'));
        
    }

    public function agregarAmigo4(Request $request){
        $user_id = auth()->user()->id;
        $nuevaLista = new Amigo();
        $nuevaLista->user_id_uno = $user_id;
        $nuevaLista->user_id_dos = $request->idUserPeticion;
        $nuevaLista->estado_peticion = 0;
        $nuevaLista->save();

        $nuevaLista = new Amigo();
        $nuevaLista->user_id_dos = $user_id;
        $nuevaLista->user_id_uno = $request->idUserPeticion;
        $nuevaLista->estado_peticion = 0;
        $nuevaLista->save();


        return redirect()->back()->with('success');
    } 

    public function agregarAmigo(Request $request){
        $user_id = auth()->user()->id;


        $lista = Amigo::where('user_id_uno', $request->idUserPeticion)
                      ->where('user_id_dos', $user_id)
                      ->first();


        $lista2 = Amigo::where('user_id_dos', $request->idUserPeticion)
                      ->where('user_id_uno', $user_id)
                      ->first();

    
        if ($lista) {
            $lista->delete();
            $lista2->delete();
        } else {
            $user_id = auth()->user()->id;
            $nuevaLista = new Amigo();
            $nuevaLista->user_id_uno = $user_id;
            $nuevaLista->user_id_dos = $request->idUserPeticion;
            $nuevaLista->estado_peticion = 0;
            $nuevaLista->save();

            $nuevaLista = new Amigo();
            $nuevaLista->user_id_dos = $user_id;
            $nuevaLista->user_id_uno = $request->idUserPeticion;
            $nuevaLista->estado_peticion = 0;
            $nuevaLista->save();
        }
        return redirect()->back()->with('success');

    }

    
    
}
