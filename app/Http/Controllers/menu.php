<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Package;
use Illuminate\Http\Request;

class menu extends Controller
{
    public function index()
    {
        $categories  = Category::with('packages')->Category()->get();
        return view('pages.menu.menu-index', compact('categories'));
    }


    public function detail($encryptedId)
    {
        $id = decrypt($encryptedId);
        $categories = Category::with('packages')
            ->whereHas('packages', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->get();
        $package  = Package::with('include')->where('id', $id)->first();
        return view('pages.menu.detail', compact('package'));
    }
    public function addon()
    {
        $categories  = Category::Addon()->with('sub_category')->get();
        // dd($categories);
        return view('pages.menu.addon', compact('categories'));
    }
}
