@extends('layouts.app')

@section('titulo')
        Editar perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg:white shadow p-6">

                <form method="POST" action="{{route('perfil.store')}}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                    @csrf
                    <div class="mb-5">
                        <label for="username" class="mb-2 block uppercase text-gray-500 font-bold"> Username </label>

                        <input id="username" name="username" type="text" placeholder="Nombre de usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"  value="{{ auth()->user()->username}}" />

                        @error('username')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold"> Imagen perfil </label>

                        <input id="imagen" name="imagen" type="file"  " class="border p-3 w-full rounded-lg"   accept=".jpg,.jpeg,.png" />

                       
                    </div>
                    <div class="mb-5">
                        <label for="email" class="mb-2 block uppercase text-gray-500 font-bold"> Cambiar correo </label>

                        <input id="email" name="email" type="email" placeholder="Email"  class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"  value="{{ auth()->user()->email}}"/>

                        @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
                        @enderror
                    </div> 
                    <div class="mb-5">
                        <label for="oldPassword" class="mb-2 block uppercase text-gray-500 font-bold">Antiguo Password</label>
                        <input id="oldPassword" name="oldPassword" type="password" placeholder="Tu Password" class="border p-3 w-full rounded-lg @error('oldPassword') border-red-500 @enderror">
                        @error('oldPassword')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="newPassword" class="mb-2 block uppercase text-gray-500 font-bold">Nuevo Password</label>
                        <input id="newPassword" name="newPassword" type="password" placeholder="Tu Password" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                        @error('newPassword')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="submit" value="Guardar cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
                </form>

        </div>
    </div>
@endsection