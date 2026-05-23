<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function hello(string $your_name)
    {
        return "Halo salam kenal " . $your_name;
    }
}