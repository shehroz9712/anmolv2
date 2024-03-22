<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $guarded = [];

    use HasFactory;


    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id')->with('price');
    }


    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }
    public function dishes()
    {
        return $this->morphOne(PackageInclude::class, 'sharable');
    }
}
