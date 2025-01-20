<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceStyleController extends Controller
{
    public function store(Request $request)
    {


        dd($request->all());
    }
}
