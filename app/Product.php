<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function servingSize()
    {
    	return $this->hasOne(\App\ServingSize::class, 'product_id', 'id');
    }

    public function foodHistories()
    {
        return $this->hasMany(\App\FoodHistory::class);
    }
}
