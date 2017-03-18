<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Residence;

use App\Notification;

use App\User;

class NotificationController extends Controller
{
    public function postNotification(Request $request, Residence $residence)
    {
        
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'telephone' => 'nullable|regex:/^\(?([0-9]{3})\)?\s?([0-9]{3})-?([0-9]{4})$/',
            'comment' => 'required|min:10|max:190'
        ]);
        
        if(\Session::has($residence->id))
        {
            return;
        }
        
        $notification = new Notification;
        
        $notification->setProperties($request);
        
        $residence->addNotification($notification);
        
        $residenceSessionId = 'residence' . $residence->id;
        
        $request->session()->put($residenceSessionId, $notification);
        
        $recipient = User::find($residence->user_id);
        
        $notification->sendMail($recipient);
        
        return 'Thanks, the property manager has been notified.';
        
    }
    
    public function goToNotifications()
    {
        $notifications = [];
        
        $residences = \Auth::user()->residences;
        
        if(count($residences) > 0)
        {
            foreach($residences as $residence)
            {
                if(count($residence->notifications) > 0)
                {
                    foreach($residence->notifications as $notification)
                    {
                        $notifications[] = $notification;
                    }
                }
            }
        }
        
        return view('layouts.notifications.notifications', compact('notifications'));
    }
}

/**
 * do the notifications view.
 * model factories and database seeding.
 * fix the schemas (change to ints or floats accordingly).
 * clean the styling in each html page.
 * put the javascript in their according files.
 * minify the css and javascripts.
 * refactor backend code as much as possible & upload to github.
 */