<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServingSize extends Model
{
    protected $table = 'serving_size';

    public function product()
    {
    	return $this->belongsTo(App\Product, 'id', 'product_id');
    }
}
