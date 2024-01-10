<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tipo;
use App\Models\User;
use Carbon\Carbon;
use Faker\Core\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(){
        $posts = Post::where('id', 1)->get();
        return view('posts.index', compact('posts'));
    }

    public function feed(){
        $userId = auth()->id();

        $posts = Post::join('amigos', 'posts.user_id', '=', 'amigos.user_id_dos')
                        ->join('users', 'posts.user_id', '=', 'users.id')
                        ->select('users.*', 'posts.*')
                        ->where('amigos.user_id_uno', $userId)
                        ->orderBy('posts.id', 'desc')
                        ->paginate(5); 
                    
        return view('posts.feed', compact('posts'));
    } 

    public function descubre(){
        $posts = DB::table('posts')
                    ->join('users', 'posts.user_id', '=', 'users.id')
                    ->where('users.is_perfil_publico', 1)
                    ->select('users.*', 'posts.*')
                    ->orderBy('posts.id', 'desc')
                    ->paginate(5);

        return view('posts.descubre', compact('posts'));
    }

    public function todosMisPosts(){
        $idLogged = auth()->id();

        $posts = Post::where('user_id', $idLogged)->get();

        return view('dashboard', compact('posts'));
    }

    public function conseguirCategoria($categoria){
        $idLogged = auth()->id();

        $posts = Post::join('amigos', 'posts.user_id', '=', 'amigos.user_id_dos')
                        ->join('users', 'posts.user_id', '=', 'users.id')
                        ->select('users.*', 'posts.*')
                        ->where(function ($query) use ($idLogged) {
                            $query->where('amigos.user_id_uno', $idLogged)
                                ->orWhere('users.is_perfil_publico', 1);
                        })
                        ->where('categoria', '=', $categoria)
                        ->orderBy('posts.id', 'desc')
                        ->paginate(5);
        return view('posts.categoria', compact('posts'));
    }

    public function create(Request $request){
        $idLogged = auth()->id();

        //consulta
        $latestPost = Post::where('user_id', $idLogged)
                    ->orderByDesc('id')
                    ->first();

        //meto en variables lo que se manda desde el formulario
        $titulo = $request->titulo;
        $contenido = $request->contenido;
        $categoria = $request->categoria;
        $imagen = $request->imagen;
        $imagenSql = $request->imagen;

        //para subir las imagenes al servidor
        $ruta = null;
        if($imagenSql){
            $request->validate([
                'imagen' => 'file|image|max:2048'
            ]); 
            $imagen = $request->file('imagen');
            $ruta = $imagen->store('posts', 'public');
        }

        //comprobacion de que el usuario no haya publicado en el ultimo dia y de si tiene alguna publicacion
        if ($latestPost) {
            $publicacion = Post::find($latestPost->id);


            $fechaActual = now();

            $fechaActual = Carbon::parse($fechaActual);
            $fechaPublicacion = Carbon::parse($publicacion->updated_at);

            //return $fechaActual . " - " . $fechaPublicacion;


            $post = new Post();
            $post->user_id = $idLogged;
            $post->titulo = $titulo;
            $post->slug = $titulo;
            $post->contenido = $contenido;
            $post->categoria = $categoria;
            $post->imagen = $ruta;

            if ($fechaActual->isSameDay($fechaPublicacion)) {
                return view('posts.aviso', compact('post'));                
            } else {
                $post->save();
                return redirect('/feed');
            }
        } else {
            $post = new Post();
            $post->user_id = $idLogged;
            $post->titulo = $titulo;
            $post->slug = $titulo;
            $post->contenido = $contenido;
            $post->categoria = $categoria;
            $post->imagen = $ruta;

            $post->save();
            return redirect('/feed');
        }
    }



    

    
}
