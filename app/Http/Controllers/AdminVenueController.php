<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminVenue;
use App\Models\User; // Import the User model if you have a 'createdby' relationship.

class AdminVenueController extends Controller
{
    public function index()
    {
        $adminVenues = AdminVenue::with('createdBy')->get();
        return view('Admin.Admin-Venue.admin_venue_index', compact('adminVenues'));
    }
   

    public function create()
    {
        return view('Admin.Admin-Venue.admin_venue_create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'required|string',
        ]);
    
        $adminVenue = new AdminVenue($request->all());
        $adminVenue->createdby = auth()->user()->id;
        $adminVenue->save(); // Save the model using the instance
    
        return redirect()->route('admin-venues.index')->with('message', 'Venue Added Successfully');
    }
    
    public function show(AdminVenue $adminVenue)
    {
        return view('admin-venues.show', compact('adminVenue'));
    }

    public function edit(AdminVenue $adminVenue)
    {
        return view('Admin.Admin-Venue.admin_venue_edit', compact('adminVenue'));
    }

    public function update(Request $request, AdminVenue $adminVenue)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'required|string',
        ]);

        $adminVenue->update($request->all());
        $adminVenue->save();
        return redirect()->route('admin-venues.index')->with('message','Venue Updated Successfully');
    }

    public function destroy(AdminVenue $adminVenue)
    {
        $adminVenue->delete();
        return redirect()->route('admin-venues.index')->with('message','Venue Updated Successfully');
    }
}

