<?php

namespace App\Http\Controllers;

use App\Models\CustomerVenue;
use App\Models\Event;
use App\Models\EventMenu;
use App\Models\Journey;
use App\Models\Occasion;
use App\Models\Type;
use App\Traits\NotificationTrait;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Mpdf\Mpdf;

class EventController extends Controller
{
    use NotificationTrait;
    public function index()
    {

        if (Auth::user()->Role == "Admin") {

            $events = Event::with('journey')->orderBy('date', 'DESC')->get();
        } else {
            $events = Event::with('journey')->where('createdby', Auth::id())->orderBy('date')->get();
        }

        return view('pages.events.events_index', compact('events'));
    }
    function calender($type = null)
    {

        $eventData = Event::with('journey');
        if ($type && $type != 'all') {
            $eventData->where('type', $type);
        }
        $events = $eventData->get();
        $appointments = [];
        foreach ($events as $appointment) {
            $originalDate = $appointment->date . $appointment->start_time;
            $dateTime = new DateTime($originalDate);
            $formattedDate = $dateTime->format('D-m h:i');


            $appointmentDate =  $formattedDate;
            $appointmentTime =  $appointment->end_time;
            $comment = $appointment->name ?? '';
            $userName = $appointment->user->name ?? 'N/A';
            $venueName = $appointment->journey->venue->name ?? 'N/A';
            $appointments[] = [
                'title' => $appointment->start_time . ' - ' . $appointment->name . ' - ' . $appointment->type. ' - ' . $appointment->guests,
                'event_title' => $appointment->name,
                'start' => $appointment->date,
                'end' => $appointment->end_time,
                'extendedProps' => [
                    'date' => $userName,
                    'user' => $userName,
                    'venue' => $venueName,
                    'noOfGuests' => $appointment->guests,
                    'totalAmount' => '$0.00',
                    'paymentStatus' => 'pending',
                    'lastEditDate' => $appointment->updated_at,
                    'fullMessage' => "Date: {$dateTime->format('d M y')}<br>" .
                        "Event: {$appointment->name}<br>" .
                        "User: {$userName}<br>" .
                        "Venue: {$venueName}<br>" .
                        "No of Guests: {$appointment->guests}<br>" .
                        "Start Time: {$formattedDate}<br>" .
                        "End Time: {$appointment->end_time}<br>" .
                        "Total Amount: $0.00<br>" .
                        "Payment Status: pending<br>" .
                        "Last Edited: {$appointment->updated_at}",
                ],
            ];
        }
        // dd($appointments);
        return view('pages.events.calender', compact('appointments', 'type'));
    }

    public function create()
    {
        $occasions = Occasion::all();
        $types = Type::all();
        return view('pages.events.events_create', compact('types', 'occasions'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required|string',
            'date' => 'required|date',
            'guests' => 'required',
            'type' => 'string',
            'start_time' => 'string',
            'end_time' => 'string'
        ]);
        // dd($data);

        if ($request['type'] == 'Other') {
            // If the type is "Other," use the value from the "Other Type" field
            $data['type'] = $request->input('otherType');
        }
        if ($request->type != 'Pick up') {
            $data['location'] = '';
        }
        // Convert the 'date' field to 'YYYY-MM-DD' format
        $date = Carbon::parse($data['date'])->format('Y-m-d');
        $data['date'] = $date;
        $data['occasion'] = '';

        // Assign the currently authenticated user as the creator of the event
        $data['createdby'] = Auth::user()->id;


        // Create a new Event instance
        $event = Event::create($data);

        // Get the ID of the created event
        $eventId = $event->id;

        // Save the event
        $event->save();
        // dd($event);
        $journey = new Journey([
            'eventid' => $eventId,
            'venueid' => null,
            'created_by' => Auth::user()->id,
        ]);
        $journey->save();
        if ($event->type == 'Pick up' || $event->type == 'Drop-off') {
            return redirect()->route('menu.index')
                ->with('message', 'Event created successfully.');
        } else
            // Redirect to the venue creation page with the event ID
            return redirect()->route('customer-venues.createWithId', encrypt($eventId))
                ->with([
                    'message' => 'Event created successfully.',

                ]);


        // return redirect()->route('ContractIndex')
        //      ->with('message', 'Event created successfully.');
    }


    public function continueJourney(Request $request)
    {
        $journey = Journey::where(
            'eventid',
            $request->eventId
        )->firstOrFail();

        $eventId = encrypt($request->eventId);
        $event = Event::where('id', $request->eventId)->firstOrFail();
        // dd($event);
        if ($event->type == 'pick up' || $event->type == 'Drop-off') {

            return redirect()->route('menu.index', $eventId);
        }
        if (!$journey->venue) {
            Session::put('eventId', $request->eventId);

            return redirect()->route('customer-venues.createWithId', $eventId);
        }
        if (!$journey->menu_submit) {
            return redirect()->route('menu.index', $eventId);
        }
        if (!$journey->service_styling_id) {
            return redirect()->route('service.styling', $eventId);
        } else {
            return redirect()->route('equipment.index', $eventId);
        }
    }

    public function show(Request $request, $id)
    {
        $id = decrypt($id);
        $journey = Journey::where('eventid', $id)->with('event', 'venue', 'ServiceStyling', 'package')->firstOrFail();
        $menu = EventMenu::where('event_id', $journey->eventid)->with('dishes')->get();
        return view('pages.events.show', compact('journey', 'menu'));
    }

    public function edit(Request $request, $id)
    {
        // Decrypt the encrypted ID
        // $decryptedId = Crypt::decryptString($encryptedId);
        $eventId = decrypt($id);
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
            'status' => 'integer',
        ]);

        // $decryptedId = Crypt::decryptString($request->input('encrypted_id'));

        $event = Event::findOrFail($request->eventId);

        if ($data['type'] == 'Other') {
            $data['type'] = $request->input('otherType');
        }

        if ($request->type != 'Pick up') {
            $data['location'] = '';
        }
        // if ($data['occasion'] === 'Other') {
        //     $data['occasion'] = $request->input('otherOccasion');
        // }
        $date = Carbon::parse($data['date'])->format('Y-m-d');
        $data['date'] = $date;
        $event->update($data);
        if (Auth::user()->Role != "Admin") {
            $this->sendNotification('admin', Auth::id(), 'Edit Event ', 'User edit this event event event name : ' . $request->name);
        } else {
            $this->sendNotification('user',  $event->createdby, 'Edit Event ', 'Admin edit this event event name : ' . $request->name);
        }


        return redirect()->route('events.index')->with('message', 'Event updated successfully.');
    }


    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('message', 'Event deleted successfully.');
    }


    function invoice(Request $request, $id)
    {
        $id = decrypt($id);
        $journey = Journey::where('eventid', $id)->with('event', 'venue', 'ServiceStyling', 'package')->firstOrFail();
        $menu = EventMenu::where('event_id', $journey->eventid)->with('dishes')->get();
        return view('pages.events.invoice', compact('journey', 'menu'));
    }
    function print_invoice(Request $request, $id)
    {
        $id = decrypt($id);
        $journey = Journey::where('eventid', $id)->with('event', 'venue', 'ServiceStyling', 'package')->firstOrFail();
        $menu = EventMenu::where('event_id', $journey->eventid)->with('dishes')->get();

        $pdf = new Dompdf();


        $pdf->loadHtml(view('pages.events.invoice', compact('journey', 'menu')));
            $pdf->setPaper('legal', 'portrait');
            $pdf->render();

            $output = $pdf->output();
            return response($output, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="form.pdf"');



//         $html = view('pages.events.invoice', compact('journey', 'menu'))->render();

//         // Initialize MPDF

// $mpdf = new \Mpdf\Mpdf(['tempDir' => storage_path('temp'), 'memory_limit' => '512M']);

//         // Write HTML to the MPDF object
//         $mpdf->WriteHTML($html);

//         // Output the PDF
//         return response($mpdf->Output('invoice.pdf', 'i'), 200)
//             ->header('Content-Type', 'application/pdf');
    }
}
