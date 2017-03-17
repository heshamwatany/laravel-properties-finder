<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;

use App\Residence;

use Illuminate\Support\Collection;

use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Pagination\Paginator;

class SearchController extends Controller
{
    public function algoliaSearch(Request $request)
    { 
        $keywords = Input::get('keywords');
        
        $facetFilters =  $this->getFacetFilters($request);
        
        $results = Residence::search(
            $keywords, 
            [
                "facets" => ['type', 'category'],
                'hitsPerPage' => 10,
                'facetFilters' => $facetFilters, 
            ]
        );
        
        $query = $this->getSuggestions($results['hits'], $keywords);
        
        return view('layouts.search.suggestions', compact('query'));
    }
    
    public function executeSearch(Request $request)
    {
        
        $facetFilters =  $this->getFacetFilters($request);
        
        $appliedFilters = $this->getFilters($request);
        
        $perPage = 24;
        
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        
        $keywords = $request['query'];
        
        $index = $this->getIndex($request)['index'];
        
        $indexNum = $this->getIndex($request)['indexNum'];
        
        $query = Residence::search(
            $keywords,[
                "index" => $index,
                "facets" => [
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
                'facetFilters' => $facetFilters, 
                'hitsPerPage' => $perPage, 
                'page' => $currentPage - 1
            ]
        );
        
        $collection = new Collection($query['hits']);

        $results = new LengthAwarePaginator(
            $collection, 
            $query['nbHits'], 
            $perPage, 
            $currentPage, 
            ['path' => $request->url(), 
            'query' => $request->query()]
        );
        
        $items = $results->items();
        
        $facets = $query['facets'];
        
        $nbHits = $query['nbHits'];
        
        return view('layouts.results.search_results', 
                    compact(
                        'items',
                        'results',
                        'facets', 
                        'keywords',
                        'appliedFilters',
                        'nbHits',
                        'indexNum'
                    )
                );
    }
    
    public function getFacetFilters(Request $request)
    {
        $filters = [];
        
        if($request['state']) array_push($filters, 'state:' . $request['state']);
        
        if($request['city']) array_push($filters, 'city:' . $request['city']);
        
        if($request['has_garden']) array_push($filters, 'has_garden:' . $request['has_garden']);
        
        if($request['has_pool']) array_push($filters, 'has_pool:' . $request['has_pool']);
        
        if($request['is_used']) array_push($filters, 'is_used:' . $request['is_used']);
        
        if($request['construction_area_range']) array_push($filters, 'construction_area_range:' . $request['construction_area_range']);
        
        if($request['price_range']) array_push($filters, 'price_range:' . $request['price_range']);
        
        if($request['area_range']) array_push($filters, 'area_range:' . $request['area_range']);
        
        if($request['is_direct']) array_push($filters, 'is_direct:' . $request['is_direct']);
        
        if($request['number_of_bathrooms']) array_push($filters, 'number_of_bathrooms:' . $request['number_of_bathrooms']);
        
        if($request['number_of_rooms']) array_push($filters, 'number_of_rooms:' . $request['number_of_rooms']);
        
        if($request['parking_spots']) array_push($filters, 'parking_spots:' . $request['parking_spots']);
        
        //if($request['photos']) array_push($filters, 'photos:' . $request['photos']);
        
        if($request['type']) array_push($filters, 'type:' . $request['type']);
        
        if($request['category']) array_push($filters, 'category:' . $request['category']);
        
        if($request['pet_friendly'] != 0) array_push($filters, 'pet_friendly:' . $request['pet_friendly']);
        
        if($request['laundry'] != 0) array_push($filters, 'laundry:' . $request['laundry']);
        
        if($request['utilities_included'] != 0) array_push($filters, 'utilities_included:' . $request['utilities_included']);
        
        if($request['furniture_included'] != 0) array_push($filters, 'furniture_included:' . $request['furniture_included']);
        
        if($request['wifi_included'] != 0) array_push($filters, 'wifi_included:' . $request['wifi_included']);
        
        return $filters;
        
    }
    
    public function getFilters(Request $request)
    {
        $parameters = collect($request->request)->toArray();
        
        $filters = [
            'category' => 1,
            'type' => 2,
            'state' => 3,
            'city' => 4,
            'has_garden' => 5,
            'has_pool' => 6,
            'is_direct' => 7,
            'area_range' => 8,
            'construction_area_range' => 9,
            'price_range' => 10,
            'area_range' => 11,
            'is_used' => 12,
            'number_of_rooms' => 13,
            'number_of_bathrooms' => 14,
            'parking_spots' => 15,
            'pet_friendly' => 16, 
            'laundry' => 17,
            'utilities_included' => 18,
            'furniture_included' => 19, 
            'wifi_included' =>20
        ];
        
        return $appliedFilters = array_intersect_key($parameters, $filters);
        
    }
    
    public function getIndex(Request $request)
    {
        $index = 'residences';
        
        $indexNum = 0;
        
        $indexes = [
            1 => 'price_asc',
            2 => 'area_asc',
            3 => 'price_desc',
            4 => 'area_desc'
        ];
        
        if(array_key_exists($request['sortBy'], $indexes))
        {
            $index = $indexes[$request['sortBy']];
            $indexNum = $request['sortBy'];
        }
        
        return compact('index','indexNum');
        
    }
    
    public function getSuggestions($hits, $keywords)
    {
        $stateMatches = []; $statePredictions = [];
        $cityMatches = []; $cityPredictions = [];
        $streetAdressMatches = [];
        
        $temp = [];
        
        foreach($hits as $hit)
        {
            $highlightResult = $hit['_highlightResult'];
            
            $state = $highlightResult['state'];
            $city = $highlightResult['city'];
            $streetAdress = $highlightResult['street_adress'];
            
            $state['value'] = str_replace("<em>","",str_replace("</em>","",$state['value']));
            $city['value'] = str_replace("<em>","",str_replace("</em>","",$city['value']));
            $streetAdress['value'] = str_replace("<em>","",str_replace("</em>","",$streetAdress['value']));
            
            
            if(!array_key_exists($streetAdress['value'] . ", " . $city['value'] . ", " . $state['value'], $streetAdressMatches) && $streetAdress['matchLevel'] != 'none')
            {
                $streetAdressMatches[$streetAdress['value'] . ", " . $city['value'] . ", " . $state['value']] = 1;
            }
            elseif(array_key_exists($streetAdress['value'] . ", " . $city['value'] . ", " . $state['value'], $streetAdressMatches) && $streetAdress['matchLevel'] != 'none')
            {
                $streetAdressMatches[$streetAdress['value'] . ", " . $city['value'] . ", " . $state['value']]++;
            }
            
            if(!array_key_exists($city['value'] . ", " . $state['value'], $cityMatches) && $city['matchLevel'] != 'none')
            {
                $cityMatches[$city['value'] . ", " . $state['value']] = 1;
                
                $prediction =  $streetAdress['value'] . ", " . $city['value'] . ", " . $state['value'];
                
                if(array_key_exists($prediction, $streetAdressMatches)) $streetAdressMatches[$prediction]++;
                else $cityPredictions[$prediction] = 1;
            }
            elseif(array_key_exists($city['value'] . ", " . $state['value'], $cityMatches) && $city['matchLevel'] != 'none')
            {
                
                $cityMatches[$city['value'] . ", " . $state['value']]++;
                
                if(array_key_exists($prediction, $cityPredictions)) $cityPredictions[$prediction]++;
                elseif(array_key_exists($prediction, $streetAdressMatches)) $streetAdressMatches[$prediction]++;
                else $cityPredictions[$prediction] = 1;
                
            }
            
            if(!array_key_exists($state['value'], $stateMatches) && $state['matchLevel'] != 'none')
            {
                $stateMatches[$state['value']] = 1;
                
                $prediction =  $city['value'] . ", " . $state['value'];
                
                if(array_key_exists($prediction, $cityMatches)) $cityMatches[$prediction]++;
                else $statePredictions[$prediction] = 1;
            }
            elseif(array_key_exists($state['value'], $stateMatches) && $state['matchLevel'] != 'none')
            {
                $stateMatches[$state['value']]++;
                
                $prediction =  $city['value'] . ", " . $state['value'];
                
                if(array_key_exists($prediction, $statePredictions)) $statePredictions[$prediction]++;
                elseif(array_key_exists($prediction, $cityMatches)) $cityMatches[$prediction]++;
                else $statePredictions[$prediction] = 1;
                
            }
    
        }
        
        arsort($stateMatches);arsort($cityMatches); 
        arsort($statePredictions); arsort($cityPredictions);
        arsort($streetAdressMatches);
        
        if(array_sum($stateMatches) >= array_sum($cityMatches)
            && array_sum($cityMatches) >= array_sum($streetAdressMatches))
        {
            return $query = array_keys(array_merge($stateMatches, $statePredictions,
                $cityMatches, $streetAdressMatches, $cityPredictions));
        }
        elseif(array_sum($stateMatches) < array_sum($cityMatches) 
            && array_sum($cityMatches) >= array_sum($streetAdressMatches) && strlen($keywords) > strlen(array_first(array_keys($stateMatches))))
        {
            return $query = array_keys(array_merge($statePredictions, $cityMatches,
                $streetAdressMatches, $cityPredictions));
        }
        elseif(array_sum($stateMatches) < array_sum($cityMatches) 
            && array_sum($cityMatches) < array_sum($streetAdressMatches) && strlen($keywords) > strlen(array_first(array_keys($stateMatches))))
        {
            return $query = array_keys(array_merge($streetAdressMatches, $cityPredictions, $streetAdressMatches, $cityMatches));
        }
        else
        {
            return $query = array_keys(array_merge($stateMatches, $statePredictions, $cityMatches, 
                $streetAdressMatches, $cityPredictions));
        }

    }
    
}


