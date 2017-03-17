<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $fillable = ['title', 'description'];
    
    public function setProperties($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }
    
    public function residence()
    {
        return $this->belongsTo('App\Residence');
    }
}
