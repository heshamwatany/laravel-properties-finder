<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Laravel\Scout\Searchable;

use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

class Photo extends Model
{
    //use Searchable;
    
    use AlgoliaEloquentTrait;
    
    protected $fillable = ['path', 'is_profile'];

    public function residence()
    {
        $this->belongsTo('App\Residence');
    }
    
}
