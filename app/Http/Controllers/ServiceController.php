<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Journey;
use App\Models\Occasion;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;


class ServiceController extends Controller
{


    public function create()
    {
        return view('pages.service.service');
    }
    public function store(Request $request)
    {

        // Redirect to the venue creation page with the event ID
        return redirect()->route('equipment.index')
            ->with([
                'message' => 'Service Style Save successfully.',
            ]);
    }



    public function continueJourney(Request $request)
    {
        $journey = Journey::where(
            'eventid',
            '=',
            $request->eventId
        )->firstOrFail();
        $event = Event::where(
            'id',
            '=',
            $request->eventId
        )->firstOrFail();
        // dd($event);
        if ($event->type == 'Pick up' || $event->type == 'Drop-off') {

            return redirect()->route('ContractIndex');
        }
        if (!$journey->venue) {
            Session::put('eventId', $request->eventId);

            return redirect()->route('customer-venues.createWithId');
        } else {
            return redirect()->route('menu.index');
        }
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Request $request)
    {
        // Decrypt the encrypted ID
        // $decryptedId = Crypt::decryptString($encryptedId);
        $eventId = $request->eventId;
        // Retrieve the event by ID
        $event = Event::findOrFail($eventId);

        $occasions = Occasion::all();
        $types = Type::all();

        return view('pages.events.events_edit', compact('event', 'eventId', 'types', 'occasions'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'string',
            'guests' => 'required',
            'date' => 'required|date',
            'occasion' => 'string',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        // $decryptedId = Crypt::decryptString($request->input('encrypted_id'));

        $event = Event::findOrFail($request->eventId);

        if ($data['type'] == 'Other') {
            $data['type'] = $request->input('otherType');
        }

        // if ($data['occasion'] === 'Other') {
        //     $data['occasion'] = $request->input('otherOccasion');
        // }
        $date = Carbon::parse($data['date'])->format('Y-m-d');
        $data['date'] = $date;

        $event->update($data);

        return redirect()->route('events.index')->with('message', 'Event updated successfully.');
    }


    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('message', 'Event deleted successfully.');
    }
}
