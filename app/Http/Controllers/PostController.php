<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show','index']);

    }
    
        
    
    public function index(User $user)
    {

        //dd($user->username);

        $posts = Post::where('user_id', $user->id)->latest()->paginate(4);

        return view('dashboard',[
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function create()
    {

        //dd($user->username);
        return view('posts.create');
    }

    public function store(Request $request)
    {

       // dd('creando');

       $this->validate($request, [

            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'

       ]);
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('post.index', auth()->user()->username);
    }

    public function show( User $user, Post $post){

        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post){

        //dd('eliminando');

        $this->authorize('delete', $post);
        $post->delete();

        $imagen_path = public_path('uploads/'.$post->imagen);

        if (File::exists($imagen_path)){
            unlink($imagen_path);
            
        }

        return redirect()->route('post.index', auth()->user()->username);

    }
}
