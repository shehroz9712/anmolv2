<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventMenuRequest;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Equipment;
use App\Models\Event;
use App\Models\EventMenu;
use App\Models\Journey;
use App\Models\MenuQuery;
use App\Models\Package;
use App\Models\Price;
use App\Models\SubCategory;
use App\Traits\NotificationTrait;
use Exception;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class menu extends Controller
{
    use NotificationTrait;
    public function index(Request $request, $eventId = null)
    {

        $eventId = $eventId;
        $categories  = Category::with('packages')->Category()->get();

        return view('pages.menu.menu-index', compact('categories', 'eventId'));
    }

    function menu_edit(Request $request, $eventId = null)
    {

        $eventId = decrypt($eventId);
        $menus  = EventMenu::with('dishes')->where('event_id', $eventId)->get();
        $dishes = Dish::with('subcategory')->get();

        return view('pages.menu.menu-edit', compact('menus', 'dishes', 'eventId'));
    }
    function menu_edit_request(Request $request, $eventId = null)
    {

        $eventId = decrypt($eventId);
        $menus  = EventMenu::with('dishes')->where('event_id', $eventId)->get();
        $dishes = Dish::with('subcategory')->get();

        $request_dishes =  MenuQuery::where('eventId', $eventId)->with('oldDish', 'newDish')->get();

        return view('pages.menu.menu-edit', compact('menus', 'dishes', 'request_dishes', 'eventId'));
    }
    function acceptDishChange(Request $request)
    {
        // Create or update the MenuQuery record
        $query = MenuQuery::updateOrCreate(
            ['old_dish_id' => $request->old_dish_id],
            ['new_dish_id' => $request->new_dish_id, 'status' => 1] // Assuming status 1 means accepted
        );


        $dish = EventMenu::where(['event_id' => $request->eventId, 'dish_id' => $request->old_dish_id])->first();

        $dish->update([
            'dish_id' => $request->new_dish_id
        ]);
        return response()->json(['message' => 'Dish change accepted successfully.']);
    }
    function menu_query(Request $request)
    {
        // Retrieve the old and new dishes arrays from the request
        $oldDishes = $request->input('olddishes', []);
        $newDishes = $request->input('newdishes', []);
        $eventId = $request->input('eventId');
        $event = Event::find($eventId);

        // Loop through the arrays and create a MenuQuery record for each pair
        foreach ($oldDishes as $index => $oldDishId) {
            // Ensure there is a corresponding new dish for the current old dish
            if (isset($newDishes[$index])) {
                $newDishId = $newDishes[$index];
                MenuQuery::where('old_dish_id', $oldDishId)->delete();
                MenuQuery::create([
                    'old_dish_id' => $oldDishId,
                    'new_dish_id' => $newDishId,
                    'eventId' => $eventId,
                    'status' => 0,
                ]);
            } else {
                continue;
            }
            $this->sendNotification('admin', 10, 'Edit Event ', $event->user->name ." create a change menu request for event: ". $event->name);
        }

        // Optionally, you can return a response or redirect
        return redirect()->back()->with('success', 'Menu queries created successfully.');
    }
    public function getDishes(Request $request)
    {
        $dishes = null;
        if ($request->id) {
            $dishes = Dish::whereIn('id', $request->id)->with('subcategory')->where('status', 1)->get();

            foreach ($dishes as $dish) {
                if ($dish->price != 0) {
                    $dish->final_price = $dish->price;
                } else {

                    $numOfDishesInCategory = count($dishes->where('subcategory_id', $dish->subcategory_id));

                    // Retrieve all prices for this dish's subcategory from the price table
                    $prices = Price::where('category_id', $dish->subcategory_id)->get();

                    // Find the price based on the number of dishes in this category
                    $price = $prices->where('pick', $numOfDishesInCategory)->first();
                    // If there is no price for the current number of dishes, use the last available price
                    if (!$price) {
                        $price = $prices->last();
                    }

                    $dish->final_price = $price->price;
                    // $dish->equipment_price = $price->equipment->equipment ?? 0;

                    // $numOfDishesInCategory = count($dishes->where('subcategory_id', $dish->subcategory_id));

                    // $subcat = SubCategory::find($dish->subcategory_id);
                    // if ($numOfDishesInCategory == 1) { // Use == instead of =
                    //     $dish->final_price = $subcat->single;
                    // } elseif ($numOfDishesInCategory == 2) { // Use == instead of =
                    //     $dish->final_price = $subcat->double;
                    // } else {
                    //     $dish->final_price = $subcat->trio;
                    // }
                }
            }
            return response()->json($dishes); // Use response() helper function
        } else {
            return response()->json($request); // Use response() helper function
        }
    }
    public function detail($encryptedId, $eventId = null)
    {
        $id = decrypt($encryptedId);
        $eventId = $eventId;

        $categories = Category::with('packages')
            ->whereHas('packages', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->get();
        $package  = Package::with('include')->where('id', $id)->first();
        return view('pages.menu.detail', compact('package', 'eventId'));
    }
    public function addon(Request $request, $eventId = null)
    {

        $eventId = $eventId;
        $categories = Category::Addon()
            ->whereHas('sub_category', function ($query) {
                $query->where('is_addon', 1);
            })
            ->with('sub_category')
            ->get();
        return view('pages.menu.addon', compact('categories', 'eventId'));
    }
    public function getNewDishes(Request $request)
    {


        $dish = Dish::find($request->oldDishId);
        $dishes = Dish::where('subcategory_id', $dish->subcategory_id)->with('subcategory')->get();

        return response()->json($dishes); // Use response() helper function

    }
    public function items(Request $request, $eventId = null)
    {

        $eventId = $eventId;

        $categories = Category::Addon()
            ->whereHas('sub_category', function ($query) {
                $query->where('is_addon', 0);
            })
            ->with('sub_category')
            ->get();
        return view('pages.menu.addon', compact('categories', 'eventId'));
    }
    public function submit(Request $request)
    {
        // try {
        $event_id =  decrypt($request->eventId);
        $journey = Journey::where('eventid', $event_id)->first();

        if ($request->url == 'items') {

            Journey::where('eventid', $event_id)->update(
                [
                    'package_id' =>  0,
                    'menu_submit' => 1
                ]
            );
            if ($request->dishid) {

                foreach ($request->dishid as $item) {
                    EventMenu::create([
                        'dish_id' => $item,
                        'event_id' => $event_id,
                        'type' => 'custom',
                    ]);
                }
            }
            if ($request->navigate_to_addon == "no") {
                return redirect()->route('service.styling', $request->eventId)
                    ->with('message', 'menu items submit successfully.');
            }

            return redirect()->route('menu.addon', $request->eventId)
                ->with('message', 'Menu submit successfully.');
        } elseif ($request->url == 'package') {
            $package_id = $request->package;
            $journey = Journey::where('eventid', $event_id)->first();
            Journey::where('eventid', $event_id)->update(
                [
                    'package_id' => $package_id ?? 0,
                    'menu_submit' => 1
                ]
            );
            if ($request->dishid) {

                foreach ($request->dishid as $item) {
                    if ($item) {

                        EventMenu::create([
                            'dish_id' => $item,
                            'event_id' => $event_id,
                            'type' => $request->url,
                        ]);
                    }
                }
            }
            if ($request->navigate_to_addon == "no") {
                return redirect()->route('service.styling', $request->eventId)
                    ->with('message', 'menu items submit successfully.');
            }


            return redirect()->route('menu.addon', $request->eventId)
                ->with('message', 'Package submit successfully.');
        } else {

            Journey::where('eventid', $event_id)->update(
                [
                    'menu_submit' => 1,
                    'special_instruction' => $request->instruction,

                ]
            );
            if ($request->dishid) {

                foreach ($request->dishid as $item) {
                    EventMenu::create([
                        'dish_id' => $item,
                        'event_id' => $event_id,
                        'type' => 'addon',
                    ]);
                }
            }

            return redirect()->route('service.styling', $request->eventId)
                ->with('message', 'Addon items submit successfully.');
        }
        // } catch (Exception $e) {
        //     return redirect()->back()->with('error', $e->getMessage());
        // }
    }
    public function equipment(Request $request)
    {
        $event_id = $request->eventId ? decrypt($request->eventId) : '1';
        $event = Event::find($event_id);

        $dish = EventMenu::with('dishes.equipment')->where('event_id', $event_id)->get();
        // dd($dish);
        $equipments  = Equipment::Active()->get();
        return view('pages.equipment.index', compact('dish', 'event'));
    }
}
