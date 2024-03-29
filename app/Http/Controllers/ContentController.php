<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request, Response};
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function getHome(){
        $minutes = 60;
        $categories = Category::where('module','0')->orderBy('name','Asc')->get();
        $sliders = Slider::where('status', 1)->orderby('sorder','Asc')->get();
        $data = ['categories'=> $categories, 'sliders'=>$sliders];
        Cookie::queue(Cookie::make('name',Str::random(8),$minutes));
        return view('home',$data);
    }

}
