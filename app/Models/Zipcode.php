<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{
    use HasFactory;
 
    public function sttlements() {
        return $this->hasMany(Zipcode::class,'d_codigo');
    }

    public function zipcode() {
        return $this->belongsTo(Zipcode::class,'d_codigo');
    }

}
