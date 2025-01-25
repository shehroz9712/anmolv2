<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Price;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::with('category','serviceStyle')->get();
        return view('Admin.subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where(['type' => 2, 'status' => 1])->get();
        return view('Admin.subcategory.create', compact('categories'));
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
                'number',
                'price',
            ]
        );

        $subcategory = SubCategory::create($data);
        $price = $request->input('price');
        $numbers = $request->input('number');

        foreach ($numbers as $key => $number) {
            if (!empty($number)) {
                Price::create([
                    'category_id' => $subcategory->id,
                    'price' => $price[$key],
                    'pick' => $numbers[$key],
                ]);
            }
        }

        return redirect()->route('subcategories.index')->with('message', 'Sub Category Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = decrypt($id);
        $record = SubCategory::find($id);
        return view('Admin.subcategory.view', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = decrypt($id);
        $categories = Category::where(['type' => 2, 'status' => 1])->get();
        $record = SubCategory::with('category','serviceStyle')->find($id);
        return view('Admin.subcategory.edit', compact('record', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except(
            [
                '_token',
                '_method',
                'number',
                'price',
            ]
        );

        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update($data);

        Price::where('category_id', $id)->delete();

        $price = $request->input('price');
        $numbers = $request->input('number');

        foreach ($numbers as $key => $number) {
            if (!empty($number)) {
                Price::create([
                    'category_id' => $id,
                    'price' => $price[$key],
                    'pick' => $numbers[$key],
                ]);
            }
        }
        // Update the main package details

        return redirect()->route('subcategories.index')->with('message', 'Sub Category Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
