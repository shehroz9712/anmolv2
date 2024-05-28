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

    public function create(Request $request, $eventId = null)
    {

        $eventId = $eventId;

        // Provide data for creating a new customer venue (e.g., admin venues and users)
        $venues  = AdminVenue::all();
        $users = User::all();

        return view('pages.customer_venues.customer_venue_create', compact('venues', 'users', 'eventId'));
    }

    public function store(Request $request)
    {
        //   dd($request->all());
        // Validate and store a new customer venue
        $request->validate([
            'ContactPerson' => 'nullable|string',
            'ContactEmail' => 'nullable|email',
            'ContactPhone' => 'nullable|string',
            'address' => 'required|nullable|string',

        ]);

        // Create an AdminVenue and associate it with the authenticated user
        $customerVenue = new CustomerVenue([
            'createdby' => auth()->user()->id,
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'ContactPerson' => $request->ContactPerson,
            'ContactEmail' => $request->ContactEmail,
            'event_id' => $request->event_id,
        ]);




        if ($request->event_id != null) {

            $journey = Journey::where(
                'eventid',
                '=',
                $request->event_id
            )->firstOrFail();
            $journey->venueid = $customerVenue->id;
            $journey->update();
        }

        return redirect()->route('menu.index', encrypt($request->event_id))->with('message', 'Venue Added Successfully');
    }





    public function edit(Request $request, $id)
    {
        $venueId = decrypt($id);

        $venue = CustomerVenue::findOrFail($venueId);
        return view('pages.customer_venues.customer_venue_edit', compact('venueId', 'venue'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'ContactPerson' => 'nullable|string',
            'ContactEmail' => 'nullable|email',
            'ContactPhone' => 'nullable|string',
            'address' => 'required|nullable|string',

        ]);
        $venue = CustomerVenue::find($request->venueId);

        // Create an AdminVenue and associate it with the authenticated user
            $venue->update([
                'createdby' => auth()->user()->id,
                'name' => $request->name,
                'address' => $request->address,
                'city' => $request->city,
                'ContactPerson' => $request->ContactPerson,
                'ContactPhone' => $request->ContactPhone,
                'ContactEmail' => $request->ContactEmail,
            ]);
        return redirect()->route('events.index')->with('message', 'Updated Successfully');
    }


    public function destroy(CustomerVenue $customerVenue)
    {
        $customerVenue->delete();

        return redirect()->route('customer-venues.index')->with('message', 'Deleted Successfully');
    }
}
