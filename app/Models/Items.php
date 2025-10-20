<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Items extends Pivot
{
    protected $table = "items";

    protected $fillable = [
        "name",
        "quantity",
        "notes",
        "description",
        "user_id",
    ];

    public function inputByUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function places(){
        return $this->belongsToMany(Place::class, 'item_place')
                ->withTimestamps();
    }
}