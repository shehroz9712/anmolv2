<?php

namespace App\Models;

use App\Models\Journey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'guests', 'type', 'date', 'occasion', 'start_time', 'end_time', 'createdby', 'location', 'address', 'otherType'];
    protected $dates = ['deleted_at'];

    public function createdby()
    {
        return $this->belongsTo(User::class, 'id', 'createdby');
    }
    /**
     * Get the user that owns the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'createdby', 'id');
    }

    public function getCreatedUserAttribute()
    {
        return $this->user ? $this->user->name : null;
    }

    /**
     * Get the journey associated with the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function journey(): HasOne
    {
        return $this->hasOne(Journey::class, 'eventid', 'id');
    }
}
