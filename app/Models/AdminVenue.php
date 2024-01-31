<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminVenue extends Model
{
    use HasFactory, SoftDeletes;
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'createdby');
    }


    protected $fillable = ['name', 'address', 'city', 'state', 'zipcode', 'createdby'];

    protected $dates = ['deleted_at'];
}
