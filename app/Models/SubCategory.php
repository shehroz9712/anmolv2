<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function dishes()
    {
        return $this->hasMany(Dish::class, 'subcategory_id', 'id')->where('status', 1);
    }
    public function price()
    {
        return $this->hasMany(Price::class, 'category_id', 'id')->where('status', 1);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
