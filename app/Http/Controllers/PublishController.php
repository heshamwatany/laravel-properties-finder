<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Residence;

use App\Publication;

use App\Description;

use App\ContactInfo;

use Validator;

use Illuminate\Validation\Rule;

class PublishController extends Controller
{
    public function goToPublishProperty()
    {
        return view('layouts.publish.publish_property');
    }
    
    public function setTypeAndCategory(Request $request)
    {
        Validator::make($request->all(), [
            'type' => [
                'required',
                Rule::in([
                    'house', 
                    'appartment',
                    'commercial_space',
                    'office_space'
                ])
            ],
            'category' => [
                'required',
                Rule::in([
                    'rent',
                    'lease_takeover',
                    'shared_rent',
                ])
            ]
        ])->validate();
        
        $publication = new Publication($request->type, $request->category);
        
        $session = $request->session();
       
        $session->put('publication', $publication);
        
        return redirect('locate_property');
    }
    
    public function goToPropertyLocation()
    {
        return view('layouts.publish.property_location');
    }
    
    public function setLocation(Request $request)
    {
        if($request->session()->has('publication'))
        {
            if($request->state_input != null 
            && in_array($request->state_input, Publication::$states_abbr_names))
            {
                $request->state_input = array_search($request->state_input, Publication::$states_abbr_names);
                return $request->state_input;
            }
            
            Validator::make($request->all(), [
               'street_adress' => 'required|min:3|max:180',
               'city_input' => 'required|min:3|max:180',
               'state_input' => [
                    'required', 
                    Rule::in(Publication::$states_abbr),
                    'min:2,max:2'
                ],
                'zip_code_input' => 'required|min:5|max:11'
            ])->validate();
            
            $state = null;
        
            if(in_array($request->state_input, Publication::$states_abbr_names))
            {
                $state = array_search($request->state_input, Publication::$states_abbr_names);
            }
            
            $states_names = Publication::$states_abbr_names;
            
            $publication = $request->session()->get('publication');
            
            $state = null;
        
            if(in_array($request->state_input, Publication::$states_abbr_names))
            {
                $state = array_search($request->state_input, Publication::$states_abbr_names);
            }
            else
            {
                $state = $request->state_input;
            }
            
            $publication->setLocation(
                $request->street_adress,
                $request->city_input,
                $states_names[$state],
                $request->zip_code_input
            );
            
            $request->session()->put('publication', $publication);
            
            return view('layouts.publish.property_description');
        }
        else
        {
            return back();
        }
    }
    
    public function postResidence(Request $request)
    {   
        if($request->session()->has('publication'))
        {
            $yesNo = ['required', Rule::in([1, 0])];
            
            $numeric = ['required', 'integer', Rule::in([0, 1, 2, 3, 4, 5, 6])];
            
            $specific = ['required', 'min:10', 'max:100000000', 'integer'];
            
            $telephone = 'nullable|regex:/^\(?([0-9]{3})\)?\s?([0-9]{3})-?([0-9]{4})$/';
            
            Validator::make($request->all(),[
                'accept' => 'required',
                'is_used' => $yesNo,
                'has_garden' =>  $yesNo,
                'has_pool' => $yesNo,
                'is_direct' => $yesNo,
                'laundry' => $yesNo,
                'furniture_included' => $yesNo,
                'wifi_included' => $yesNo,
                'utilities_included' => $yesNo,
                'pet_friendly' => $yesNo,
                'number_of_rooms' => $numeric,
                'number_of_bathrooms' => $numeric,
                'parking_spots' => $numeric,
                'area' => $specific,
                'construction_area' => $specific,
                'price' => $specific,
                'description' => 'required|min:10|max:190',
                'telephone' => $telephone,
                'alternate_telephone' => $telephone,
                'email' => 'email',
                'title' => 'required|min:5|max:40'
            ])->validate();

            $publication = $request->session()->get('publication');
            
            $residence = new Residence;
            
            $residence->setPublicationFields($publication);
            
            $residence->setDescriptionFields($request);
            
            \Auth::user()->addResidence($residence);
          
            $description = new Description;
            
            $description->setProperties($request->title, $request->description);
            
            $residence->addDescription($description);
                
            $contactInfo = new ContactInfo;
            
            $contactInfo->setProperties($request);
            
            $residence->addContactInfo($contactInfo);
                
            $request->session()->forget('publication');
            
            return redirect('review_publication/' . $residence->id);
            
        }
        else
        {
            return back();    
        }
    }
    
    public function goToReview(Residence $residence)
    {
        if($residence->user_id == \Auth::user()->id) 
        {
            return view('layouts.publish.publication_review', compact('residence'));
        }
        else return back();
    }
    
}
