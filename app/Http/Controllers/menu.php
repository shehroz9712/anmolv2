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
        $categories = Category::Addon()
            ->whereHas('sub_category', function ($query) {
                $query->where('is_addon', 1);
            })
            ->with('sub_category')
            ->get();
        return view('pages.menu.addon', compact('categories'));
    }
    public function items()
    {
        $categories = Category::Addon()
            ->whereHas('sub_category', function ($query) {
                $query->where('is_addon', 0);
            })
            ->with('sub_category')
            ->get();
        return view('pages.menu.addon', compact('categories'));
    }
    public function submit(Request $request)
    {
        if ($request->url == 'items') {
            return redirect()->route('menu.addon')
                ->with('message', 'Menu submit successfully.');
        } elseif ($request->url == 'package') {
            return redirect()->route('menu.addon')
                ->with('message', 'Package submit successfully.');
        } else {
            return redirect()->route('ContractIndex')
                ->with('message', 'Addon items submit successfully.');
        }
    }
}
