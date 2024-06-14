<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class PainelController extends Controller
{
    public function index()
    {
        $users = Users::all();
        return view('painel', compact('users'));
    }
    
}
