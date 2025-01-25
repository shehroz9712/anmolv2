<?php

namespace App\Http\Controllers;

use App\Models\CourseType;
use App\Models\Category;

use Illuminate\Http\Request;

class ServiceStyleController extends Controller
{


    public function create(Request $request, $eventId)
    {
        $course_types =  CourseType::with('ServiceStyles')->get();
        $categories = Category::where(['type' => 2, 'status' => 1])->get();

        return view('pages.service.service', compact('course_types', 'eventId'));
    }

     public function store(Request $request)
    {
        $eventId = $request->eventId;
        $selectedCourseTypes = array_keys($request->except('_token'));
        $selectedServiceStyles = collect($request->except('_token'))->flatten();

        // Fetch the required data with eager loading
        $courseTypes = CourseType::with(['serviceStyles.subCategories.dishes'])
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
