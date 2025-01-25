<?php

namespace App\Http\Controllers;

use App\Models\CourseType;
use Illuminate\Http\Request;

class CourseTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coursetypes = CourseType::all();
        return view('Admin.coursetype.index', compact('coursetypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('coursetypes.index');
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

        $Coursetype = CourseType::create($data);
        return redirect()->route('coursetypes.index')->with('message', 'Course Type Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = decrypt($id);
        $course = CourseType::find($id);
        return view('Admin.coursetype.view', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = decrypt($id);
        $course = CourseType::find($id);
        return view('Admin.coursetype.edit', compact('course'));
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
        $coursetypes = CourseType::find($id);
        $coursetypes->update($data);
        return redirect()->route('coursetypes.index')->with('message', 'Course Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
