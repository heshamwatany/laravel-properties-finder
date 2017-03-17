<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Photo;

use App\Residence;

use App\Publication;

use Illuminate\Validation\Rule;

class ResidenceController extends Controller
{
    public function postProfilePhoto(Request $request, Residence $residence)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpg,jpeg,png|max:3000'
        ]);
        
        if( \Auth::user()->id == $residence->user_id &&
            count($residence->photos) < 8 && 
            count($residence->photos()->where('is_profile', '=', true)->get()) == 0)
        {
            $is_profile = true;
            return $this->uploadPic($residence, $request, $is_profile);
        }
        else
        {
            return 'You already have a profile pic.';
        }
        
    }
    
    public function postPhotos(Request $request, Residence $residence)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpg,jpeg,png|max:3000'
        ]);
        
        if(\Auth::user()->id == $residence->user_id &&
            count($residence->photos) < 8)
        {
           $is_profile = false;
           return $this->uploadPic($residence, $request, $is_profile);
        }
        else
        {
            return 'Number of photos exceeded.';
        }
        
    }
    
    public function uploadPic(Residence $residence, Request $request, $is_profile)
    {
        $file = $request->file('file');
        
        $name = time() . $file->getClientOriginalName();
            
        $file->move('residences/photos', $name);
            
        $path = '/residences/photos/' . $name;
            
        $photo = new Photo;
            
        $photo->path = $path;
            
        if($is_profile == true)
        {
            $photo->is_profile = true;
        }
            
        $residence->addPhoto($photo);
            
        $photo_id = $photo->id;
            
        $residence_id = $residence->id;
            
        return compact('residence_id', 'photo_id');   
    }
    
    public function deletePhotos(Request $request, Photo $photo)
    {
        $this->validate($request,[
            'photo_id' => 'required|exists:photos,id',
            'residence_id' => 'required|exists:residences,id'
        ]);
        
        return $this->erasePhoto($photo);
    }
    
    public function deleteUploadedPhotos(Photo $photo)
    {
        $this->erasePhoto($photo);
               
        return back();
    }
    
    public function erasePhoto(Photo $photo)
    {
        if(\Auth::user()->id = Residence::find($photo->residence_id)->user_id)
        {
            if(\File::exists(public_path() . $photo->path))
            {
                \File::delete(public_path() . $photo->path);
                
                $photo->delete();
                
                return;
            }
        }
        else
        {
            return 'There was an error';
        }
    }
    
    public function editResidence(Request $request, Residence $residence)
    {
        $yesNo = ['required', Rule::in([1, 0])];
            
        $numeric = ['required', 'integer', Rule::in([0, 1, 2, 3, 4, 5, 6])];
            
        $specific = ['required', 'min:10', 'max:100000000', 'integer'];
            
        $telephone = 'nullable';
        
        $this->validate($request,[
            'street_adress' => 'required|min:3|max:180',
            'city_input' => 'required|min:3|max:180',
            'state_input' => [
                'required', 
                Rule::in(Publication::$states_abbr),
                'min:2,max:2'
            ],
            'zip_code_input' => 'required|min:5|max:11',
            'type' => [
                'required',
                Rule::in([
                    'house', 
                    'appartment',
                    'storage_unit',
                    'commercial_space',
                    'office_space',
                    'land'
                ])
            ],
            'category' =>[
                'required',
                Rule::in([
                    'sale', 
                    'rent',
                    'lease_takeover',
                    'shared_rent',
                ])
            ],
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
        ]);
        
        $state = null;
        
        if(in_array($request->state_input, Publication::$states_abbr_names))
        {
            $state = array_search($request->state_input, Publication::$states_abbr_names);
        }
        else
        {
            $state = $request->state_input;
        }
        
        $residence->setEditionFields(
            $request, 
            Publication::$states_abbr_names[$state]
        );
        
        $residence->setDescriptionFields($request);
        
        $residence->save();
        
        $description = $residence->descriptions;
        
        $description->setProperties(
            $request->title,
            $request->description
        );
        
        $description->save();
        
        $contactInfo = $residence->contactInfos;
        
        $contactInfo->setProperties($request);
        
        $contactInfo->save();
        
        return redirect('/residence_main/' . $residence->id);
    }
    
    public function reportResidence(Residence $residence)
    {
        if($residence->report())
        {
            return 'Reported';
        }
    }
}
