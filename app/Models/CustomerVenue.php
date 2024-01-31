<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerVenue extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ContactPerson',
        'ContactEmail',
        'ContactPhone',
        'createdby',
    ];

    public function adminVenue()
    {
        return $this->belongsTo(AdminVenue::class, 'admin_venue_id');
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
