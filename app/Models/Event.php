<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'guests', 'type', 'date', 'occasion', 'start_time', 'end_time', 'createdby', 'location', 'address', 'otherType'];
    protected $dates = ['deleted_at'];
    public function createdby()
    {
        return $this->belongsTo(User::class, 'createdby');
    }
}
