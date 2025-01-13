<?php

namespace App\Http\Controllers;

use App\Models\VenueInfo;
use App\Models\Journey;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\Event;
use App\Traits\NotificationTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


class VenueController extends Controller
{
    use NotificationTrait;
    public function index()
    {
        // Retrieve all customer venues with relations
        $Venues = Venue::with(['venueInfo', 'createdBy'])->where('createdBy', Auth::id())->get();

        return view('pages.venues.index', compact('Venues'));
    }

    public function getContactDetails(Request $request)
    {
        $address = $request->input('address');

        // Search for the venue in the database based on the address
        $venue = VenueInfo::where('address', $address)->first();

        if ($venue) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'contact_person' => $venue->contact_person,
                    'contact_email' => $venue->contact_email,
                    'contact_phone' => $venue->contact_phone,
                ],
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'No contact details found.']);
    }


    public function create(Request $request, $eventId = null)
    {

        $users = User::all();

        return view('pages.venues.create', compact('users', 'eventId'));
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

        // Create an VenueInfo and associate it with the authenticated user
        $Venue = Venue::create([
            'createdby' => auth()->user()->id,
            'name' => $request->venueAddress,
            'address' => $request->address,
            'city' => $request->city,
            'ContactPerson' => $request->ContactPerson,
            'ContactEmail' => $request->ContactEmail,
            'event_id' => $request->event_id,
        ]);


        if ($request->event_id != null) {

            $journey = Journey::where(
                'eventid',
                $request->event_id
            )->firstOrFail();

            $journey->update([
                'venueid' => $Venue->id,
            ]);
        }

        return redirect()->route('service.styling', encrypt($request->event_id))->with('message', 'Venue Added Successfully');
    }





    public function edit(Request $request, $id)
    {
        $venueId = decrypt($id);

        $venue = Venue::findOrFail($venueId);
        return view('pages.venues.edit', compact('venueId', 'venue'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'ContactPerson' => 'nullable|string',
            'ContactEmail' => 'nullable|email',
            'ContactPhone' => 'nullable|string',
            'address' => 'required|nullable|string',

        ]);
        $venue = Venue::find($request->venueId);

        // Create an VenueInfo and associate it with the authenticated user
        $venue->update([
            'createdby' => auth()->user()->id,
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'ContactPerson' => $request->ContactPerson,
            'ContactPhone' => $request->ContactPhone,
            'ContactEmail' => $request->ContactEmail,
        ]);
        $journey =  Journey::where('venueid', $request->venueId)->first();
        if ($journey) {

            $event = Event::find($journey->eventid);
            if (Auth::user()->Role != "Admin") {
                $this->sendNotification('admin', 10, 'Edit Venue ', 'User edit this venue event id#' . $event->name);
            } else {
                $this->sendNotification('user', $venue->createdby, 'Edit Event ', 'Admin edit this venue event id#' . $event->name);
            }
        }
        return redirect()->route('events.index')->with('message', 'Updated Successfully');
    }


    public function destroy(Venue $Venue)
    {
        $Venue->delete();

        return redirect()->route('Venues.index')->with('message', 'Deleted Successfully');
    }
}
