<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
