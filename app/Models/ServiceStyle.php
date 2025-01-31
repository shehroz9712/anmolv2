<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceStyle extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    /**
     * Get the coursetype that owns the ServiceStyle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coursetype(): BelongsTo
    {
        return $this->belongsTo(CourseType::class,'course_type_id','id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
