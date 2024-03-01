<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use App\Models\Package;
use App\Models\Price;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class menu extends Controller
{
    public function index()
    {
        $categories  = Category::with('packages')->Category()->get();
        return view('pages.menu.menu-index', compact('categories'));
    }
    

    public function getDishes(Request $request)
    {
        $dishes = null;
        if ($request->id) {
            $dishes = Dish::whereIn('id', $request->id)->with('subcategory')->where('status', 1)->get();

            foreach ($dishes as $dish) {
                if ($dish->price != 0) {
                    $dish->final_price = $dish->price;
                } else {
                    $numOfDishesInCategory = count($dishes->where('subcategory_id', $dish->subcategory_id));

                    $subcat = SubCategory::find($dish->subcategory_id);
                    if ($numOfDishesInCategory == 1) { // Use == instead of =
                        $dish->final_price = $subcat->single;
                    } elseif ($numOfDishesInCategory == 2) { // Use == instead of =
                        $dish->final_price = $subcat->double;
                    } else {
                        $dish->final_price = $subcat->trio;
                    }
                }
            }
            return response()->json($dishes); // Use response() helper function
        } else {
            return response()->json($request); // Use response() helper function
        }
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
