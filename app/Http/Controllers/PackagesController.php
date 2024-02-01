<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Package;
use App\Models\PackageInclude;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::with('category', 'include')->get();
        return view('Admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where(['type' => 1, 'status' => 1])->get();
        $subcategories = SubCategory::where(['status' => 1])->get();
        return view('Admin.packages.create', compact('categories', 'subcategories'));
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
                'category',
                'number'
            ]
        );

        $package = Package::create($data);

        $categories = $request->input('category');
        $numbers = $request->input('number');

        // Loop through each category and number pair
        foreach ($categories as $key => $category) {
            if (!empty($category)) {
                PackageInclude::create([
                    'package_id' => $package->id,
                    'sharable_type' => 'App\Models\SubCategory',
                    'sharable_id' => $category,
                    'qty' => $numbers[$key],
                ]);
            }
        }
        return redirect()->route('packages.index')->with('message', 'Package Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = category::where(['type' => 1, 'status' => 1])->get();
        $subcategories = SubCategory::where(['status' => 1])->get();
        $packageincludes  = PackageInclude::with('sharable')->where(['package_id' => $id])->get();
        $package = Package::find($id);
        return view('Admin.packages.view', compact('package', 'packageincludes', 'categories', 'subcategories'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = category::where(['type' => 1, 'status' => 1])->get();
        $subcategories = SubCategory::where(['status' => 1])->get();
        $packageincludes  = PackageInclude::where(['package_id' => $id])->get();
        $package = Package::find($id);
        return view('Admin.packages.edit', compact('package', 'packageincludes', 'categories', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except([
            '_token',
            '_method',
            'category',
            'number',
        ]);

        // Update the main package details
        $package = Package::findOrFail($id);
        $package->update($data);

        // Delete existing package includes for the package
        PackageInclude::where('package_id', $id)->delete();

        $categories = $request->input('category');
        $numbers = $request->input('number');

        // Loop through each category and number pair
        foreach ($categories as $key => $category) {
            if (!empty($category)) {
                PackageInclude::create([
                    'package_id' => $id,
                    'sharable_type' => 'App\Models\SubCategory',
                    'sharable_id' => $category,
                    'qty' => $numbers[$key],
                ]);
            }
        }

        return redirect()->route('packages.index')->with('message', 'Package Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
