<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'name','lat', 'lng', 'country', 'province', 'city', 'address', 'phone', 'radius', 'geographical', 'user_id'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
