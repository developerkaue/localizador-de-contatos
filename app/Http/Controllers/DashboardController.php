<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class DashboardController extends Controller
{

    public function index(Request $request){
        // Your logic here
        return response()->json('Dashboard content', 200);
    }

    public function store(Request $request){
        
    }
}
