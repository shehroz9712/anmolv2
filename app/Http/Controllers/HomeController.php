<?php

namespace App\Http\Controllers;

use App\Models\CustomerVenue;
use App\Models\Event;
use App\Models\Journey;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");
        if (Auth::check()) {
            $role = Auth::user()->Role;
            if ($role == "User" || $role == "Guest") {
                $events = Event::where('createdby', Auth::id())->get();
                $upcomingEvent = Event::where([['date', '>=', now()], ['createdby', Auth::id()]])
                    ->orderBy('date', 'asc')
                    ->first();
                $venue = null;
                if ($upcomingEvent != null) {

                    $venue = CustomerVenue::with(['adminVenue',])->where('event_id', $upcomingEvent->id)->first();
                }
                $journey = Journey::where('created_by', Auth::id())->first();

                return view('Dashboard.pages.home', compact('events', 'upcomingEvent', 'venue', 'journey'));
            } else if ($role == "Kitchen" || $role == "kitchen") {
                // dd("user");
                return view('kithen.kitchen-home');
            } else if ($role == "Admin") {


                $events = Event::all();
                $upcomingEvent = Event::where('date', '>=', now())
                    ->orderBy('date', 'asc')
                    ->first();
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
                        'title' =>  $appointment->name,
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
                $users = User::count();
                // Get the start and end of the current month
                $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
                $endOfMonth = Carbon::now()->endOfMonth()->toDateString();

                // Retrieve events for the current month
                $event_count = Event::whereBetween('date', [$startOfMonth, $endOfMonth])->count();
                $today_count = Event::where('date', '=', now())->count();

                return view('Admin.adminhome', compact('users', 'today_count', 'event_count', 'events', 'appointments', 'upcomingEvent'));
            } else {
                return Redirect::back();
                // dd($role);
            }
        }
    }
    public function adminHome()
    {

        $events = Event::all();
        $upcomingEvent = Event::where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->first();
        return view('Admin.adminhome', compact('events', 'upcomingEvent'));
    }
    public function kitchenHome()
    {

        return view('kithen.kitchen-home');
    }
    public function ContractIndex()
    {
        return view('pages.contract.contract_index');
    }
}
