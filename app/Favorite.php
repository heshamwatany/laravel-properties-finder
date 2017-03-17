<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public function user()
    {
        return $this->belongsTo('App/User');
    }
    
    public function favoriteItems()
    {
        return $this->hasMany('App\FavoriteItem');
    }
    
    public function addFavoriteItem(FavoriteItem $favoriteItem)
    {
        return $this->favoriteItems()->save($favoriteItem);
    }
}
