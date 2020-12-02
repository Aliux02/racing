<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class better extends Model
{
    use HasFactory;

    public function horse()
    {
        return $this->belongsTo('App\Models\Horse','horse_id', 'id');
    }
    
}
