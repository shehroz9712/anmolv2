<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view('pages.types.types_index', compact('types'));
    }

    public function create()
    {
        return view('Types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Type::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->back()->with('message', 'Type created successfully.');
    }

    public function edit($id)
    {
        $Type = Type::findOrFail($id);
        return view('Types.edit', compact('Type'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $Type = Type::findOrFail($id);
        $Type->name = $request->input('name');
        $Type->save();

        return redirect()->back()->with('message', 'Type updated successfully.');
    }

    public function destroy($id)
    {
        $Type = Type::findOrFail($id);
        $Type->delete();

        return redirect()->back()->with('message', 'Type deleted successfully.');
    }
}
