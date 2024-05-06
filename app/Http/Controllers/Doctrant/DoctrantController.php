<?php

namespace App\Http\Controllers\Doctrant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctrantController extends Controller
{
    public function index()
    {

        return view("doctrant.index");
    }

    public function profile()
    {
        // return view("fonctionnaire.p");
    }
}
