<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class horse extends Model
{
    use HasFactory;

    public function betters()
    {
        return $this -> hasMany('App\Models\Better','horse_id', 'id');
    }
}
