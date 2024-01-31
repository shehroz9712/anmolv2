<?php

namespace App\Http\Controllers;

use App\Models\AdminVenue;
use App\Models\Journey;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CustomerVenue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


class CustomerVenueController extends Controller
{
    public function index()
    {
        // Retrieve all customer venues with relations
        $customerVenues = CustomerVenue::with(['adminVenue', 'createdBy'])->where('createdBy', Auth::id())->get();

        return view('pages.customer_venues.customer_venue_index', compact('customerVenues'));
    }

    public function create(Request $request)
    {
        
        $eventId = $request->eventId;
        
        // Provide data for creating a new customer venue (e.g., admin venues and users)
        $venues  = AdminVenue::all();
        $users = User::all();

        return view('pages.customer_venues.customer_venue_create', compact('venues', 'users','eventId'));
    }

    public function store(Request $request)
    {
        //   dd($request->all());
        // Validate and store a new customer venue
        $request->validate([
            'ContactPerson' => 'required|string',
            'ContactEmail' => 'nullable|email',
            'ContactPhone' => 'required|string',
        ]);
        $adminVenue = null;
        if ($request->venue_id === 'other') {
            // Create an AdminVenue and associate it with the authenticated user
            $adminVenue =new AdminVenue([
                'createdby' => auth()->user()->id,
                'name' => $request->otherVenue,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zipcode' => $request->zipcode,
                // Add other fields for AdminVenue as needed
            ]);
    
            // Set the admin_venue_id to the ID of the created AdminVenue
            $request->merge(['admin_venue_id' => $adminVenue->id]);
    
            // Save the AdminVenue model
            $adminVenue->save();
    
            
        }
    
        // If admin_venue_id is not set to 'other', create a CustomerVenue
        $customerVenue = new \App\Models\CustomerVenue($request->all());
        $customerVenue->createdby = auth()->user()->id;
    
        $customerVenue->event_id = $request->event_id;
        if ($adminVenue !== null) {
            $customerVenue->admin_venue_id = $adminVenue->id;
        }else{
            $customerVenue['admin_venue_id'] = $request->venue_id;
        }
    
        $customerVenue->save();

        if($request->event_id != null){
            
            $journey = Journey::where('eventid','=',$request->event_id
            )->firstOrFail();
            $journey->venueid = $customerVenue->id;
            $journey->update();
        }
    
        return redirect()->route('menu.index')->with('message', 'Venue Added Successfully');
    }
    
    
    
    

    public function edit(Request $request)
    {
        $venueId =$request->venueId;
        // Retrieve the event by ID
        $event = CustomerVenue::findOrFail($venueId);
  
        // dd($venue);
        // Retrieve a specific customer venue for editing
       
        $venues = AdminVenue::all();
        $users = User::all();
        $venue = CustomerVenue::findOrFail($venueId);
        $venue  = $venue::with('adminVenue', 'createdBy')->where('id', $venueId)->First();
        // dd($venue);
        
    $adminVenue = AdminVenue::find($venue->admin_venue_id);
        return view('pages.customer_venues.customer_venue_edit', compact('venueId', 'venues','venue', 'users','adminVenue'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'ContactPerson' => 'required|string',
            'ContactEmail' => 'nullable|email',
            'ContactPhone' => 'required|string'
        ]);
        // $decryptedId = Crypt::decryptString($request->input('encrypted_id'));
        $customerVenue = CustomerVenue::findOrFail($request->venueId);
        // Check if the selected venue is "other"
        if ($request->venue_id === 'other') {
            // Create or update an AdminVenue and associate it with the authenticated user
            if ($customerVenue->adminVenue) { 
                $adminVenue = $customerVenue->adminVenue;
                $adminVenue->update([
                    'name' => $request->otherVenue,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zipcode' => $request->zipcode,
                ]);
            } else {
                $adminVenue = new AdminVenue([
                    'createdby' => auth()->user()->id,
                    'name' => $request->otherVenue,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zipcode' => $request->zipcode,
                ]);
                $adminVenue->save();
                $customerVenue->admin_venue_id = $adminVenue->id;
            }
        }
    
        $customerVenue->update($request->all());
    
        return redirect()->route('customer-venues.index')->with('message', 'Updated Successfully');
    }
    

    public function destroy(CustomerVenue $customerVenue)
    {
        $customerVenue->delete();

        return redirect()->route('customer-venues.index')->with('message','Deleted Successfully');
    }
}
