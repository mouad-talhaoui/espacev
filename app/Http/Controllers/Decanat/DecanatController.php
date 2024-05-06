<?php

namespace App\Http\Controllers\Decanat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DecanatController extends Controller
{
    public function index()
    {

        return view("decanat.index");
    }

    public function profile()
    {
        // return view("fonctionnaire.p");
    }
}
