<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BlockController extends Controller
{
    public function store(User $user){

        $user->blockedbyme()->attach(auth()->user()->id);

        return back();

    }

    public function destroy(User $user){

        $user->blockedbyme()->detach(auth()->user()->id);

        return back();

    }
}
