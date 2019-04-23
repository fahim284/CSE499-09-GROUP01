<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    protected $table = 'profiles';
    use SoftDeletes;
    protected $fillable = ['id'];
    /**
     * profile belongsTo user
     * @return Illuminate\Database\Eloquent\Relations\belongsTo
     * */
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
