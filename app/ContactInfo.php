<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = ['telephone', 'alternate_telephone', 'email'];
    
    public function setProperties($request)
    {
        if(!is_null($request->telephone)) $this->telephone = $request->telephone;
        if(!is_null($request->alternate_telephone)) $this->alternate_telephone = $request->alternate_telephone;
        if(!is_null($request->email)) $this->email = $request->email;
    }
    
    public function residence()
    {
        return $this->belongsTo('App/Residence');
    }
    
}
