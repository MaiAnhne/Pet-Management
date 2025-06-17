<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = ['full_name','email'];
    public function pets(){ return $this->belongsToMany(Pet::class); }
}
