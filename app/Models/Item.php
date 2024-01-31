<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['quantity', 'amount', 'name', 'description', 'imageUrl', 'isdeleted', 'deleteat', 'createdby', 'updatedby', 'itemcategoryid'];
    const CREATED_AT = 'createdat';
    const UPDATED_AT = 'updatedat';

}
