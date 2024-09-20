<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   

   
    public function index()
    {
        $data['sliders'] = Slider::where('status', true)->get();
        return view('frontend.home',$data);
    }


  

    public function managerDashboard() {

        return view('manager.dashboard');
        
    }
}
