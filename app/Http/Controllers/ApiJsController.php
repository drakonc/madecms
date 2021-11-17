<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Config;

class ApiJsController extends Controller
{
    public function getProductsSection(Request $request,$section ){
        $items_x_page = Config::get('madecms.products_per_page');
        switch($section):
            case 'home':
                $products = Product::inRandomOrder()->where('status','=',1)->paginate($items_x_page);
                break;
            default:
                $products = Product::inRandomOrder()->where('status','=',1)->paginate($items_x_page);
        endswitch;
        return response()->json($products);
    }
}
