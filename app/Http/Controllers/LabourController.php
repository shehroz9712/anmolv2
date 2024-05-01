<?php

namespace App\Http\Controllers;

use App\Models\Labour;
use Illuminate\Http\Request;

class LabourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labours = Labour::all();
        return view('Admin.labour.index', compact('labours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.labour.create');
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

        $labour = Labour::create($data);
        return redirect()->route('labours.index')->with('message', 'Labour Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $record = Labour::find($id);
        return view('Admin.labour.view', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = Labour::find($id);
        return view('Admin.labour.edit', compact('record'));
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
            ]
        );

        $labour = Labour::findOrFail($id);
        $labour->update($data);



        return redirect()->route('labours.index')->with('message', 'Labour Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
