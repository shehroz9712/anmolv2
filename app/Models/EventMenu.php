<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EventMenu extends Model
{
    protected $guarded = [];
    use HasFactory;
    protected $table =   'event_menus';



    /**
     * Get all of the dishes for the EventMenu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dishes(): HasOne
    {
        return $this->hasOne(Dish::class, 'id', 'dish_id');
    }
}
