<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Shop;

class Situation extends Model
{
    public function shops()
    {
        return $this->belongsToMany(Shop::class,'shop_situation');
    }
}
