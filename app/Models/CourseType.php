<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseType extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get all of the ServiceStyles for the CourseType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ServiceStyles(): HasMany
    {
        return $this->hasMany(ServiceStyle::class);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
