<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $guarded = [];
    use HasFactory;
    protected $table = 'equipments';
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
