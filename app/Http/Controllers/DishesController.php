<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::with('subcategory')->get();
        return view('Admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('create');
        $subcategory = SubCategory::Active()->get();

        return view('Admin.dishes.create', compact('subcategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except(
            [
                '_token',
                '_method',
            ]
        );
      
        // $this->uploadImage($data->image, 'dishes');

        $Dish = Dish::create($data);
        return redirect()->route('dishes.index')->with('message', 'Dish Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dish = Dish::find($id);
        return view('Admin.dishes.view', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcategory = SubCategory::Active()->get();
        $dish = Dish::find($id);
        return view('Admin.dishes.edit', compact('dish', 'subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except([
            '_token',
            '_method',
        ]);

        // Update the main package details
        $dishes = Dish::find($id);
        $dishes->update($data);
        return redirect()->route('dishes.index')->with('message', 'Dishes Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
