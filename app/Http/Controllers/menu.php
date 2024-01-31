<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class menu extends Controller
{
    public function index()
    {
        $categories  = Category::with('packages')->Category()->get();
        return view('pages.menu.menu-index', compact('categories'));
    }
}
