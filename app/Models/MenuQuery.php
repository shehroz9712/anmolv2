<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MenuQuery extends Model
{
    use HasFactory;
    protected $guarded;
    /**
     * Get the oldDishe associated with the MenuQuery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function oldDish(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'old_dish_id', 'id');
    }
    /**
     * Get the newDishe associated with the MenuQuery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function newDish(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'new_dish_id', 'id');
    }
}
