<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    use HasFactory;


    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id')->with('price');
    }
    public function coursetype()
    {
        return $this->belongsTo(CourseType::class);
    }
    public function servicestyle()
    {
        return $this->belongsTo(ServiceStyle::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }
    public function dishes()
    {
        return $this->morphOne(PackageInclude::class, 'sharable');
    }

    public function equipment()
    {
        return $this->belongsToMany(Equipment::class, 'dishes_equipment', 'dish_id', 'equipment_id');
    }

    public function labour()
    {
        return $this->belongsToMany(Labour::class, 'dishes_labours', 'dish_id', 'labour_id');
    }
}
