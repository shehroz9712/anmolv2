<?php

namespace App\Http\Controllers;

use App\Models\CourseType;
use App\Models\Category;

use Illuminate\Http\Request;

class ServiceStyleController extends Controller
{


    public function create(Request $request, $eventId)
    {
        $eventId = $request->eventId;

        // Fetch the required data with eager loading
        $courseTypes = CourseType::with(['serviceStyles.subCategories.items'])
           
            ->get();
        // Filter out only the selected service styles
        
        return view('pages.menu.item', compact('courseTypes', 'eventId'));
    }

     public function store(Request $request)
    {
        $eventId = $request->eventId;
        $selectedCourseTypes = array_keys($request->except('_token'));
        $selectedServiceStyles = collect($request->except('_token'))->flatten();

        // Fetch the required data with eager loading
        $courseTypes = CourseType::with(['serviceStyles.subCategories.items'])
            ->whereIn('id', $selectedCourseTypes)
            ->get();
 
        // Filter out only the selected service styles
        $courseTypes->each(function ($courseType) use ($selectedServiceStyles) {
            $courseType->setRelation(
                'serviceStyles',
                $courseType->serviceStyles->filter(function ($serviceStyle) use ($selectedServiceStyles) {
                    return $selectedServiceStyles->contains($serviceStyle->id);
                })
            );
        });
        return view('pages.menu.item', compact('courseTypes', 'eventId'));

        // Debugging
    }
}
