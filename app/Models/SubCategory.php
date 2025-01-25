<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategory extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function dishes()
    {
        return $this->hasMany(Item::class, 'subcategory_id', 'id')->where('status', 1)->orderby('name', 'ASC');
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

    /**
     * Get the serviceStyle that owns the SubCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serviceStyle(): BelongsTo
    {
        return $this->belongsTo(ServiceStyle::class);
    }
}
