<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeMy($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', 0);
    }
    // public function user()
    // {
    //     return $this->morphTo();
    // }

    // public function sender()
    // {
    //     return $this->morphTo();
    // }

}
