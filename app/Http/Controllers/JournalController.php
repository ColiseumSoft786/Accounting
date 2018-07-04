<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    public function journal(){
        $user = User::find(Auth::id());
        $firm = $user->firms;
        return view('journal.index',['firm' => $firm]);
    }
}
