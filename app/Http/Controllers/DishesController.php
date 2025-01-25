<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\DishesEquipment;
use App\Models\DishesLabour;
use App\Models\Equipment;
use App\Models\Labour;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Item::with('subcategory')->get();
        return view('Admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('create');
        $subcategory = SubCategory::Active()->get();
        $labours = Labour::Active()->get();
        $equipments = Equipment::Active()->get();
        return view('Admin.dishes.create', compact('subcategory', 'equipments', 'labours'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except(
            [
                '_token',
                '_method',
                'equipment',
                'labour',
            ]
        );
if($request->has('image')){
    
        $data['image'] =  $this->uploadImage($request->image, 'dishes');
}
        $dish = Item::create($data);
        $labour = $request->labour;
        foreach ($labour as $key => $value) {
            DishesLabour::create([
                'labour_id' => $value,
                'dish_id' => $dish->id
            ]);
        }

        return redirect()->route('dishes.index')->with('message', 'Item Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = decrypt($id);
        $dish = Item::with('equipment')->find($id);

        return view('Admin.dishes.view', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = decrypt($id);
        $subcategory = SubCategory::Active()->get();
        $labours = Labour::Active()->get();
        $equipments = Equipment::Active()->get();
        $dish = Item::with('equipment', 'labour')->find($id);
        return view('Admin.dishes.edit', compact('dish', 'subcategory', 'equipments', 'labours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except([
            '_token',
            '_method',
            'equipment',
            'labour'

        ]);

        // Update the main package details
        $dishes = Item::find($id);
if($request->has('image')){
    
        $data['image'] =  $this->uploadImage($request->image, 'dishes');
}
        $dishes->update($data);
        $equipment = $request->equipment;
        if ($equipment) {
            DishesEquipment::where(['dish_id' => $id])->delete();
            foreach ($equipment as $key => $value) {
                DishesEquipment::create([
                    'equipment_id' => $value,
                    'dish_id' => $id
                ]);
            }
        }
        $labour = $request->labour;
        if ($labour) {
            DishesLabour::where(['dish_id' => $id])->delete();
            foreach ($labour as $key => $value) {
                $lbrdata[] = [
                    'labour_id' => $value,
                    'dish_id' => $id
                ];
            }
        if(isset($lbrdata)){
            DishesLabour::insert($lbrdata);
        }
            
        }
        return redirect()->route('dishes.index')->with('message', 'Items Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
