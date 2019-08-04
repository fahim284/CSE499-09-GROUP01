<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodHistory extends Model
{
  protected $table = 'food_histories';
  use SoftDeletes;
  protected $fillable = ['id'];
    /**
     * foodHistory hasOne product
     * @return Illuminate\Database\Eloquent\Relations\hasOne
     * */
    public function product()
    {
        return $this->belongsTo(\App\Product::class);
    }

 }