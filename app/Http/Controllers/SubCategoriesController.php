<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategory = SubCategory::all();
        return view('Admin.subcategory.index', compact('subcategory'));
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
            ]
        );

        $package = SubCategory::create($data);
        return redirect()->route('subcategories.index')->with('message', 'Sub Category Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subcategory = SubCategory::find($id);
        return view('Admin.subcategory.view', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcategory = SubCategory::find($id);
        return view('Admin.subcategory.edit', compact('subcategory'));
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
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
