<?php

namespace App\Http\Controllers;

use App\Models\Coursetype;
use App\Models\Price;
use App\Models\ServiceStyle;
use Illuminate\Http\Request;

class ServiceStylesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicestyles = ServiceStyle::with('coursetype')->get();
        $coursetypes = Coursetype::where(['status' => 1])->get();

        return view('Admin.servicestyle.index', compact('servicestyles', 'coursetypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coursetypes = Coursetype::where(['status' => 1])->get();
        return view('Admin.servicestyle.create', compact('coursetypes'));
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

        $servicestyle = ServiceStyle::create($data);

        return redirect()->route('servicestyles.index')->with('message', 'Sub Coursetype Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = decrypt($id);
        $record = ServiceStyle::find($id);
        return view('Admin.servicestyle.view', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = decrypt($id);
        $coursetypes = Coursetype::where(['status' => 1])->get();
        $record = ServiceStyle::with('coursetype')->find($id);
        return view('Admin.servicestyle.edit', compact('record', 'coursetypes'));
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

        $servicestyle = ServiceStyle::findOrFail($id);
        $servicestyle->update($data);




        return redirect()->route('servicestyles.index')->with('message', 'Sub Coursetype Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
