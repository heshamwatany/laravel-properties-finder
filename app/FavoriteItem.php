<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteItem extends Model
{
    protected $fillable = ['residence_id'];

    public function favorite()
    {
        return $this->belongsTo('App\Favorite');
    }
}
