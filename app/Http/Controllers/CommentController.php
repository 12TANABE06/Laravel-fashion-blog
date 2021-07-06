<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Commentcontroller extends Controller
{
     public function index()
    {
      
        return view('chat.index');
    }
}
