<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function residences()
    {
        return $this->hasMany('App\Residence');
    }
        
    public function addResidence(Residence $residence)
    {
        return $this->residences()->save($residence);
    }
    
    public function favorites()
    {
        return $this->hasOne('App\Favorite');
    }
    
    public function addFavorite(Favorite $favorite)
    {
        return $this->favorites()->save($favorite);
    }
    
}
