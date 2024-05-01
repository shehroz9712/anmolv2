<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;



class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('pages.items.item_index', compact('items'));
    }

    public function create()
    {
        return view('pages.items.item_create');
    }

    public function store(Request $request)
    {


        $data = $request->except(['created_at', 'updated_at']);
        // Handle image upload
        if ($request->hasFile('image')) {
            $validator = Validator::make($request->all(), [
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed image types and maximum size
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $data['imageUrl'] = $imagePath;
            // dd($data);
        }

        $data['created_at'] = now();
        $data['updated_at'] = null;

        $item = Item::create($data);
        // dd($item);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }


    public function edit(Item $item)
    {
        return view('pages.items.items_edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {




        $item->update($request->all());
        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}

