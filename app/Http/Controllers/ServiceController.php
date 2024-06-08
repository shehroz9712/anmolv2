<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMenu;
use App\Models\Journey;
use App\Models\Occasion;
use App\Models\ServiceStyling;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;


class ServiceController extends Controller
{


    public function create(Request $request, $eventId)
    {

        $menu = EventMenu::with('dishes.subcategory')->where('event_id', decrypt($eventId))->get();


        $groupedData = [];

        // Iterate over each menu item
        foreach ($menu as $eventMenu) {
            $dish = $eventMenu->dishes;
            if ($dish->subcategory) {
                $term = $dish->subcategory->term;
                $subcategoryName = $dish->subcategory->name;

                // Creating a unique key for grouping
                $key = $term;
                if (!isset($groupedData[$key])) {
                    $groupedData[$key] = [];
                }

                $groupedData[$key][] = $dish;
            }
        }
        $main = $groupedData['main course'];
        $appetizer = $groupedData['appetizer'];
        return view('pages.service.service', compact('eventId', 'main', 'appetizer'));
    }
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'appetizer_start_time' => 'required|date_format:H:i A',
        //     'appetizer_end_time' => 'required|date_format:H:i A',
        //     'main_course_start_time' => 'required|date_format:H:i A',
        //     'main_course_end_time' => 'required|date_format:H:i A',
        //     'dessert_start_time' => 'required|date_format:H:i A',
        //     'dessert_end_time' => 'required|date_format:H:i A',
        //     'butler_style_start_time' => 'required|date_format:H:i A',
        //     'butler_style_end_time' => 'required|date_format:H:i A',
        // ]);

        // Create a new EventTiming instance
        $service_styling = ServiceStyling::create([
            'appetizer_start_time' => $this->timeConvert($request->appetizer_start_time),
            'appetizer_end_time' => $this->timeConvert($request->appetizer_end_time),
            'main_course_start_time' => $this->timeConvert($request->main_course_start_time),
            'main_course_end_time' => $this->timeConvert($request->main_course_end_time),
            'dessert_start_time' => $this->timeConvert($request->dessert_start_time),
            'dessert_end_time' => $this->timeConvert($request->dessert_end_time),
            'butler_style_start_time' => $this->timeConvert($request->butler_style_start_time),
            'butler_style_end_time' => $this->timeConvert($request->butler_style_end_time),
            'butler_style_start_time_1' => $this->timeConvert($request->butler_style_start_time_1),
            'butler_style_end_time_1' => $this->timeConvert($request->butler_style_end_time_1),

        ]);
        $event_id = $request->eventId ? decrypt($request->eventId) : '1';
        Journey::where('eventid', $event_id)->update(
            [
                'service_styling_id' =>  $service_styling->id,
            ]
        );

        // Redirect to the venue creation page with the event ID
        return redirect()->route('equipment.index', $request->eventId)
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
        $serviceid = $request->serviceid ? decrypt($request->serviceid) : '1';

        $service = ServiceStyling::find($serviceid);


        $eventId = 1;

        return view('pages.service.edit', compact('service', 'eventId'));
    }

    public function update(Request $request, Event $event)
    {
        $service_styling = ServiceStyling::where('id', $request->serviceId)->update([
            'appetizer_start_time' => $this->timeConvert($request->appetizer_start_time),
            'appetizer_end_time' => $this->timeConvert($request->appetizer_end_time),
            'main_course_start_time' => $this->timeConvert($request->main_course_start_time),
            'main_course_end_time' => $this->timeConvert($request->main_course_end_time),
            'dessert_start_time' => $this->timeConvert($request->dessert_start_time),
            'dessert_end_time' => $this->timeConvert($request->dessert_end_time),
            'butler_style_start_time' => $this->timeConvert($request->butler_style_start_time),
            'butler_style_end_time' => $this->timeConvert($request->butler_style_end_time),
            'butler_style_start_time_1' => $this->timeConvert($request->butler_style_start_time_1),
            'butler_style_end_time_1' => $this->timeConvert($request->butler_style_end_time_1),

        ]);

        return redirect()->route('events.index')->with('message', 'Service Styling updated successfully.');
    }
}
