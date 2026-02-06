<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    /** @use HasFactory<\Database\Factories\PlaceFactory> */
    use HasFactory;

    protected $fillable = [
        "number",
        "notes"
    ];

    public function items(){
        return $this->belongsToMany(Items::class, 'item_place', 'item_id', 'place_id');
    }
}
