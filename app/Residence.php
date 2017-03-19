<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Laravel\Scout\Searchable;

use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

use App\Publication;

class Residence extends Model
{
    //Uncomment in order to import data through php artisan scout:import
    //use Searchable; 
    
    use AlgoliaEloquentTrait;
    
    protected $fillable = [
        'category', 'street_adress', 'city',
        'zip_code', 'type', 'price','area', 
        'price_range', 'area_range', 'construction_area_range',
        'state', 'has_pool', 'has_garden', 'views', 'is_reported',
        'parking_spots', 'number_of_bathrooms', 'is_used',
        'number_of_rooms', 'is_direct', 'construction_area',
        'priority', 'pet_friendly', 'laundry', 'utilities_included',
        'furniture_included', 'wifi_included', 'inactive'
    ];
    
    public $algoliaSettings = [
        
        'attributesForFaceting' => [
            'state',
            'city',
            'type',
            'category',
            'has_garden',
            'has_pool',
            'parking_spots',
            'number_of_rooms',
            'is_direct',
            'number_of_bathrooms',
            'construction_area_range',
            'is_used',
            'price_range', 
            'area_range',
            'pet_friendly', 
            'laundry',
            'utilities_included',
            'furniture_included', 
            'wifi_included'
        ],
        
        'searchableAttributes' => [
            'state',
            'city',
            'street_adress'
        ],
        
        'customRanking' => [
            'desc(state)',
            'desc(city)',
            'desc(street_adress)'
        ],
        
        'replicas' => [
            'price_asc',
            'area_asc',
            'price_desc',
            'area_desc'
        ]
    ];

    public $replicasSettings = [
        
        'price_asc' => [
            
            'ranking' => [
                'asc(price)',
            ],
            
            'searchableAttributes' => [
                'state',
                'city',
                'street_adress'
            ],
            
            'customRanking' => [
                'asc(price)',
            ],
            
            'attributesForFaceting' => [  
                'state',
                'city',
                'type',
                'category',
                'has_garden',
                'has_pool',
                'parking_spots',
                'number_of_rooms',
                'is_direct',
                'number_of_bathrooms',
                'construction_area_range',
                'is_used',
                'price_range', 
                'area_range',
                'pet_friendly', 
                'laundry',
                'utilities_included',
                'furniture_included', 
                'wifi_included'
            ],
            
        ],
        
        'area_asc' => [
            
            'ranking' => [
                'asc(area)',
            ],
            
            'searchableAttributes' => [
                'state',
                'city',
                'street_adress'
            ],
            
            'customRanking' => [
                'asc(area)',
            ],
            
            'attributesForFaceting' => [  
                'state',
                'city',
                'type',
                'category',
                'has_garden',
                'has_pool',
                'parking_spots',
                'number_of_rooms',
                'is_direct',
                'number_of_bathrooms',
                'construction_area_range',
                'is_used',
                'price_range', 
                'area_range',
                'pet_friendly', 
                'laundry',
                'utilities_included',
                'furniture_included', 
                'wifi_included'
            ],
            
        ],
        
        'price_desc' => [
            
            'ranking' => [
                'desc(price)',
            ],
            
            'searchableAttributes' => [
                'state',
                'city',
                'street_adress'
            ],
            
            'customRanking' => [
                'desc(price)',
            ],
            
            'attributesForFaceting' => [  
                'state',
                'city',
                'type',
                'category',
                'has_garden',
                'has_pool',
                'parking_spots',
                'number_of_rooms',
                'is_direct',
                'number_of_bathrooms',
                'construction_area_range',
                'is_used',
                'price_range', 
                'area_range',
                'pet_friendly', 
                'laundry',
                'utilities_included',
                'furniture_included', 
                'wifi_included'
            ],
            
        ],
        
        'area_desc' => [
            
            'ranking' => [
                'desc(area)',
            ],
            
            'searchableAttributes' => [
                'state',
                'city',
                'street_adress'
            ],
            
            'customRanking' => [
                'desc(area)',
            ],
            
            'attributesForFaceting' => [  
                'state',
                'city',
                'type',
                'category',
                'has_garden',
                'has_pool',
                'parking_spots',
                'number_of_rooms',
                'is_direct',
                'number_of_bathrooms',
                'construction_area_range',
                'is_used',
                'price_range', 
                'area_range',
                'pet_friendly', 
                'laundry',
                'utilities_included',
                'furniture_included', 
                'wifi_included'
            ],
            
        ]
        
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
    
    public function addPhoto(Photo $photo)
    {
        return $this->photos()->save($photo);
    }
    
    public function descriptions()
    {
        return $this->hasOne('App\Description');
    }
    
    public function addDescription(Description $description)
    {
        return $this->descriptions()->save($description);
    }
    
    public function contactInfos()
    {
        return $this->hasOne('App\ContactInfo');
    }
    
    public function addContactInfo(ContactInfo $contactInfo)
    {
        return $this->contactInfos()->save($contactInfo);
    }
    
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }
    
    public function addNotification(Notification $notification)
    {
        return $this->notifications()->save($notification);
    }
    
    public function getAlgoliaRecord()
    {
        $extra_data = [];
        
        $extra_data['photos'] = array_map(function ($data) {
                return $data['path'];
            }, $this->photos->toArray());

        return array_merge($this->toArray(), $extra_data);
    }
    
    public function setPublicationFields(Publication $publication)
    {
        $this->type = $publication->type;
        $this->category = $publication->category;
        $this->street_adress = $publication->street_adress;
        $this->city = $publication->city;
        $this->state = $publication->state;
        $this->zip_code = $publication->zip_code;
    }
    
    public function setEditionFields($request, $state)
    {
        $this->type = $request->type;
        $this->category = $request->category;
        $this->street_adress = $request->street_adress;
        $this->city = $request->city_input;
        $this->state = $state;
        $this->zip_code = $request->zip_code_input;
    }
    
    public function setDescriptionFields($request)
    {
        $this->is_used = $request->is_used;
        $this->has_garden = $request->has_garden;
        $this->has_pool = $request->has_pool;
        $this->has_garden = $request->has_garden;
        $this->is_direct = $request->is_direct;
        $this->pet_friendly = $request->pet_friendly;
        $this->utilities_included = $request->utilities_included;
        $this->wifi_included = $request->wifi_included;
        $this->furniture_included = $request->furniture_included;
        $this->laundry = $request->laundry;
        
        $this->number_of_bathrooms = $request->number_of_bathrooms;
        $this->number_of_rooms = $request->number_of_rooms;
        $this->parking_spots = $request->parking_spots;
        
        $this->area = (int) $request->area;
        $this->construction_area = (int) $request->construction_area;
        $this->price = (int) $request->price;
        
        $this->area_range = $this->getAreaRange($request->area);
        $this->construction_area_range = $this->getAreaRange($request->construction_area);
        $this->price_range = $this->getPriceRange($this->price);
    }
    
    private function getAreaRange($area)
    {
        
        $range = null;
        
        if($area < 150)
        {
            return $range = 'under 150 sq. feet';
        }
        elseif($area > 200 && $area <= 500)
        {
            return $range = '150 sq. feet to 500 sq. feet';
        }
        elseif($area > 500 && $area <= 1000)
        {
            return $range = '500 sq. feet to 1,000 sq. feet';
        }
        elseif($area > 1000 && $area <= 10000)
        {
            return $range = '1,000 sq. feet to 10,000 sq. feet';
        }
        else
        {
            return $range = 'over 10,000 sq. feet';
        }
    }
    
    private function getPriceRange($price)
    {
        $range =  null;
        
        if($price <= 500)
        {
            return $range = 'under $500';
        }
        elseif($price > 500 && $price <= 1000)
        {
            return $range = '$500 to $1,000';
        }
        elseif($price > 1000 && $price <= 10000)
        {
            return $range = '$1,000 to $10,000';
        }
        elseif($price > 10000 && $price <= 100000)
        {
            return $range = '$10,000 to $100,000';
        }
        elseif($price > 100000 && $price <= 1000000)
        {
            return $range = '$100,000 to $1,000,000';
        }
        else
        {
            return $range = 'over a $1,000,000';
        }
        
    }
    
    public function report()
    {
        if($this->is_reported == false)
        {
            $this->update([
                'is_reported' => true
            ]);
            
            return true;
        }
        
        return false;
    }
    
}
