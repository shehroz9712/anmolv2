<?php

namespace App\Http\Controllers;

use App\Models\Occasion;
use Illuminate\Http\Request;

class OccasionController extends Controller
{
    public function index()
    {
        $occasions = Occasion::all();
        return view('pages.ocassions.ocassions_index', compact('occasions'));
    }

    public function create()
    {
        return view('occasions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
       
    
        Occasion::create([
            'name' => $request->input('name'),
        ]);
        

        return redirect()->back()->with('message', 'Occasion created successfully.');
    }

    public function edit($id)
    {
        $occasion = Occasion::findOrFail($id);
        return view('occasions.edit', compact('occasion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $occasion = Occasion::findOrFail($id);
        $occasion->name = $request->input('name');
        $occasion->save();

        return redirect()->back()->with('message', 'Occasion updated successfully.');
    }

    public function destroy($id)
    {
        $occasion = Occasion::findOrFail($id);
        $occasion->delete();

        return redirect()->back()->with('message', 'Occasion deleted successfully.');
    }
}
