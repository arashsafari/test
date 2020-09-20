<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
         'name','description','body','image','price','address_id','user_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
