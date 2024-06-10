<?php

namespace App\Http\Controllers;

use App\Models\CustomerVenue;
use App\Models\Event;
use App\Models\Journey;
use App\Models\User;
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
                    $originalDate = $appointment->date. $appointment->start_time;
                    $dateTime = new DateTime($originalDate);
                    $formattedDate = $dateTime->format('D-m h:i');


                    $appointmentDate =  $formattedDate;
                    $appointmentTime =  $appointment->end_time;
                    $comment = $appointment->name ?? '';

                    $appointments[] = [
                        'title' =>  $comment,
                        'start' => $appointment->date,
                        'end' => $appointment->end_time,
                    ];
                }
                // dd($appointments);

                return view('Admin.adminhome', compact('events', 'appointments', 'upcomingEvent'));
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
