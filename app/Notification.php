<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'telephone',
        'comment'
    ];
    
    public function residence()
    {
        return $this->belongsTo('App/Residence');
    }
    
    public function setProperties($request)
    {
        $this->name = $request->name;
        $this->last_name = $request->last_name;
        $this->email = $request->email;
        $this->telephone = $request->telephone;
        $this->comment = $request->comment;
    }

    public function sendMail($recipient)
    {
        $data =[
            'recipient' => $recipient,
            'notification' => $this
        ];
        
        \Mail::send('layouts.emails.notification', $data, function($message) use ($recipient) {
            $message->to($recipient->email);
            $message->subject('YouProfy Notification');
        });
    }
    
}
