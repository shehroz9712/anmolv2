<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function include()
    {
        return $this->hasMany(PackageInclude::class, 'package_id', 'id')->with('sharable', 'subcategory');
    }
}
