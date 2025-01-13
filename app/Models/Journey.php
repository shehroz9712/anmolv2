<?php

// app/Journey.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journey extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'eventid',
        'venueid',
        'created_by',
        'updated_by',
        'other_field_1',
        'other_field_2',
        // Add other fields as needed
    ];

    /**
     * Get the event associated with the journey.
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'eventid');
    }

    /**
     * Get the venue associated with the journey.
     */
    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venueid')->with('venueInfo');
    }

    /**
     * Get the user who created the journey.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the journey.
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Scope a query to only include journeys created by a specific user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCreatedBy($query, $userId)
    {
        return $query->where('created_by', $userId);
    }




    /**
     * Get the package associated with the Journey
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function package(): HasOne
    {
        return $this->hasOne(Package::class, 'id', 'package_id')->with('category');
    }

    /**
     * Get the menu associated with the Journey
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ServiceStyling(): HasOne
    {
        return $this->hasOne(ServiceStyling::class, 'id', 'service_styling_id');
    }
}
