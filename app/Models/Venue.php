<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venue extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


    public function venueInfo()
    {
        return $this->belongsTo(VenueInfo::class, 'admin_venue_id');
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'createdby');
    }
}
