<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Favorite;
use App\Residence;
use App\FavoriteItem;

class FavoriteController extends Controller
{
    public function addResidenceToFavorites(Request $request, Residence $residence)
    {
       $favorite = \Auth::user()->favorites;
       
       if(Residence::exists($residence->id) 
        && count($favorite->favoriteItems()->get()->where('residence_id', '=', $residence->id)) == 0)
       {
            $favoriteItem = new FavoriteItem;
       
            $favoriteItem->residence_id = $residence->id;
           
            $favorite->addFavoriteItem($favoriteItem);
            
            $residence->update([
                'views' => $residence->views + 1
            ]);
            
            if($request->ajax()) return 'In your favorites';
            else return redirect('/residence_main/' . $residence->id);
       }
       else return redirect('/residence_main/' . $residence->id);
    }
    
    public function goToFavorites()
    {
        $favoriteItems = \Auth::user()->favorites->favoriteItems;
        
        $residences = [];
        
        foreach($favoriteItems as $favoriteItem)
        {
            $residences[] = Residence::find($favoriteItem->residence_id);
        }
        
        return view('layouts.favorites.favorites', compact('residences'));
    }
    
    public function removeFromFavorites(Residence $residence)
    {
        $residence->update([
            'views' => $residence->views - 1
        ]);
        
        $favoriteItem = \Auth::user()
                            ->favorites
                            ->favoriteItems()
                            ->where('residence_id', '=', $residence->id)
                            ->get();
        
        $favoriteItem[0]->delete();
        
        return back();
    }
}