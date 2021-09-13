<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome(){
        return view('admin.slider.home');
    }

    public function getSliderAdd(Request $request){
        dd($request);
    }
}
