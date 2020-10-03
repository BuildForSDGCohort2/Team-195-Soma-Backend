<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id'
        
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo("App\Role");
    }

    public function lessons()
    {
        return $this->hasManyThrough("App\Lesson","App\Student","user_id","id");
    }

    public function tests()
    {
        return $this->hasManyThrough("App\Test","App\Student","user_id","id");
    }

    public function practices()
    {
        return $this->hasManyThrough("App\Practice","App\Student","user_id","id");
    }

    public function grades()
    {
        return $this->hasMany("App\Grade");
    }

}
