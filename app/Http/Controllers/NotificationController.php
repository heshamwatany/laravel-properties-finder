<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Residence;

use App\Notification;

use App\User;

use Illuminate\Support\Collection;

use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Pagination\Paginator;

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
    
    public function goToNotifications(Request $request)
    {
        $notificationsArray = [];
        
        $residences = \Auth::user()->residences;
        
        if(count($residences) > 0)
        {
            foreach($residences as $residence)
            {
                if(count($residence->notifications) > 0)
                {
                    foreach($residence->notifications as $notification)
                    {
                        $notificationsArray[] = $notification;
                    }
                }
            }
        }
        
        $results = $this->paginateResults($notificationsArray, $request);
        
        return view('layouts.notifications.notifications', $results);
    }
    
    protected function paginateResults($notificationsArray, Request $request)
    {
        $perPage = 10;
        
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        
        $collection = new Collection($notificationsArray);
        
        $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        
        $results = new LengthAwarePaginator(
                $currentPageSearchResults, 
                count($collection), 
                $perPage, 
                $currentPage, 
                ['path' => $request->url()]
        );
        
        $notifications = $results->items();
        
        return compact('notifications', 'results');
    }
    
    public function answer(Request $request, Notification $notification)
    {
        $this->validate($request,[
            'comment' => 'required|min:10|max:190'
        ]);
        
        if($notification->replied == false)
        {
            $notification->reply($request->comment, \Auth::user());
        }
        
        return 'Your message to ' . $notification->name . ' has been sent.';
    }
}

/**
 * answer through youprofy
 * add the replied property to the notification model
 * do the model factories and database seeding
 * fix the schemas (change to ints or floats accordingly).
 * clean the styling in each html page.
 * put the javascript in their according files.
 * minify the css and javascripts.
 * refactor backend code as much as possible & upload to github.
 */