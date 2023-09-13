<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        return view('perfil.index');
    }

    public function store(Request $request){

        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [ 
            'username' => 'required|min:3|max:20|unique:users,username,'.auth()->user()->id.'|not_in:twitter,editar-perfil',
            'email' => 'required|email|unique:users,imagen,'.auth()->user()->id,            
            'oldPassword' => 'min:6',
            'newPassword' => 'min:6' 
        ]);

        

        if($request->imagen){

            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid(). "." . $imagen->extension();
    
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000,1000);
    
            $imagenPath = public_path('perfiles'). '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
    
        } 

        $usuario = User::find(auth()->user()->id);
        

        $usuario->username = $request->username;
        $usuario->email = $request->email ?? auth()->user()->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        
 
            if (Hash::check($request->oldPassword, auth()->user()->password)) {
                $usuario->password = Hash::make($request->newPassword) ?? auth()->user()->password;
                
            } else {
                return back()->with('mensaje', 'La Contraseña Actual no Coincide');
            }
        
        
        $usuario->save();

        return redirect()->route('post.index',$usuario->username);

    }
}
