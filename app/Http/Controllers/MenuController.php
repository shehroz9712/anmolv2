<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventMenuRequest;
use App\Models\Category;
use App\Models\Item;
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

class MenuController extends Controller
{
    use NotificationTrait;

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
                    [$item_id, $item_price] = explode('|', $item);

                    // Create the EventMenu entry with separated values
                    EventMenu::create([
                        'item_id' => $item_id,
                        'item_price' => $item_price,
                        'event_id' => $event_id,
                        'type' => 'custom',
                    ]);
                }
            }
            if ($request->navigate_to_addon == "no") {
                return redirect()->route('menu.cart', $request->eventId)
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

                        [$item_id, $item_price] = explode('|', $item);

                        // Create the EventMenu entry with separated values
                        EventMenu::create([
                            'item_id' => $item_id,
                            'item_price' => $item_price,
                            'event_id' => $event_id,
                        ]);
                    }
                }
            }
            if ($request->navigate_to_addon == "no") {
                return redirect()->route('menu.cart', $request->eventId)
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
                    [$item_id, $item_price] = explode('|', $item);

                    // Create the EventMenu entry with separated values
                    EventMenu::create([
                        'item_id' => $item_id,
                        'item_price' => $item_price,
                        'event_id' => $event_id,
                        'type' => 'addon',
                    ]);
                }
            }

            return redirect()->route('menu.cart', $request->eventId)
                ->with('message', 'Addon items submit successfully.');
        }
        // } catch (Exception $e) {
        //     return redirect()->back()->with('error', $e->getMessage());
        // }
    }


    public function cart($eventId)
    {
        $event_id =  decrypt($eventId);

        $menus =  EventMenu::with('dishes.subcategory')->where(['event_id' =>  $event_id])->get();

        return view('pages.menu.cart', compact('menus', 'eventId'));
    }
}
