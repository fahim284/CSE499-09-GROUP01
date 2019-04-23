<?php
namespace App;

use Illuminate\Notifications\Notifiable;

use Shahnewaz\Permissible\Permissible;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Permissible
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Get full name attribute
     * */

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
    
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = self::normalizeEmail($value);
    }
    
    public function setPasswordAttribute($password)
    {
        if (!is_null($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
    
    public static function normalizeEmail($value)
    {
        return trim(strtolower($value));
    }
    /**
     * user hasOne profile
     * @return Illuminate\Database\Eloquent\Relations\hasOne
     * */
    public function profile()
    {
        return $this->hasOne(\App\Profile::class);
    }
}
