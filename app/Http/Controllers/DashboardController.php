<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Residence;

class DashboardController extends Controller
{
    public function goToDashboard()
    {
        return view('layouts.dashboard.dashboard');
    }
    
    public function goToManageResidences()
    {
        $residences = \Auth::user()->residences()->get();
        
        return view('layouts.dashboard.properties', compact('residences'));
    }
    
    public function goToEditResidence(Residence $residence)
    {
        if($residence->user_id == \Auth::user()->id)
        {
            return view('layouts.dashboard.edit_residence', compact('residence'));    
        }
        else
        {
            return back();
        }
    }
    
    public function goToResidenceMain(Residence $residence)
    {
        return view('layouts.residence_main', compact('residence'));
    }
}
