<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\DishesEquipment;
use App\Models\Equipment;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::with('subcategory')->get();
        return view('Admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('create');
        $subcategory = SubCategory::Active()->get();
        $equipments = Equipment::Active()->get();
        return view('Admin.dishes.create', compact('subcategory', 'equipments'));
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
            ]
        );

        // $this->uploadImage($data->image, 'dishes');

        $dish = Dish::create($data);
        $equipment = $request->equipment;
        foreach ($equipment as $key => $value) {
            DishesEquipment::create([
                'equipment_id' => $value,
                'dish_id' => $dish->id
            ]);
        }

        return redirect()->route('dishes.index')->with('message', 'Dish Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dish = Dish::with('equipment')->find($id);

        return view('Admin.dishes.view', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcategory = SubCategory::Active()->get();
        $equipments = Equipment::Active()->get();
        $dish = Dish::with('equipment')->find($id);
        return view('Admin.dishes.edit', compact('dish', 'subcategory', 'equipments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except([
            '_token',
            '_method',
            'equipment'
        ]);

        // Update the main package details
        $dishes = Dish::find($id);
        $dishes->update($data);
        DishesEquipment::where(['dish_id' => $id])->delete();
        $equipment = $request->equipment;
        foreach ($equipment as $key => $value) {
            DishesEquipment::create([
                'equipment_id' => $value,
                'dish_id' => $id
            ]);
        }
        return redirect()->route('dishes.index')->with('message', 'Dishes Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
