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
        "description"
    ];

    public function inputByUser(){
        $this->belongsTo(User::class);
    }
}
