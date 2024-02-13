<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function sub_category()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id')->with('dishes');
    }

    public function scopeCategory($query)
    {
        return $query->where('type', 1);
    }
    public function scopeAddon($query)
    {
        return $query->where('type', 2);
    }
    public function packages()
    {
        return $this->hasMany(Package::class, 'category_id', 'id')->with('include');
    }
}
