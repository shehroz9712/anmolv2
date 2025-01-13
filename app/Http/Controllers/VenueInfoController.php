<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VenueInfo;
use App\Models\User; // Import the User model if you have a 'createdby' relationship.

class VenueInfoController extends Controller
{
    public function index()
    {
        $venueInfos = VenueInfo::with('createdBy')->get();
        return view('Admin.venue-info.index', compact('venueInfos'));
    }


    public function create()
    {
        return view('Admin.venue-info.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'venueAddress' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'ContactPerson' => 'nullable|string|max:255',
            'ContactEmail' => 'nullable|email|max:255',
            'ContactPhone' => 'nullable|string|max:255',
            'lat' => 'nullable|string|max:255',
            'long' => 'nullable|string|max:255',
        ]);
        VenueInfo::create([
            'name' => $request->venueAddress,
            'address' => $request->address,
            'city' => $request->city,
            'contact_name' => $request->ContactPerson,
            'contact_email' => $request->ContactEmail,
            'contact_phone' => $request->ContactPhone,
            'lat' => $request->lat,
            'long' => $request->long,
            'createdby' => auth()->id(), // Assuming the user is logged in
        ]);

        return redirect()->route('venue-info.index')->with('message', 'Venue Added Successfully');
    }

    public function show(VenueInfo $venueInfo)
    {
        return view('venue-info.show', compact('venueInfo'));
    }

    public function edit(VenueInfo $venueInfo)
    {
        return view('Admin.venue-info.edit', compact('venueInfo'));
    }

    public function update(Request $request, VenueInfo $venueInfo)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'required|string',
        ]);

        $venueInfo->update($request->all());
        $venueInfo->save();
        return redirect()->route('venue-info.index')->with('message', 'Venue Updated Successfully');
    }

    public function destroy(VenueInfo $venueInfo)
    {
        $venueInfo->delete();
        return redirect()->route('venue-info.index')->with('message', 'Venue Updated Successfully');
    }
}
