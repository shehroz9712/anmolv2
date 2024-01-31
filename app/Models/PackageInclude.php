<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageInclude extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sharable_id', 'id')->with('dishes');
    }
    public function sharable()
    {
        return $this->morphTo();
    }
}
