<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JokesController extends Controller
{
    public function jokes()
    {

        return view("index.jokes",['arr'=>data_arr(),'jokes'=>jokes()]);
    }
}
