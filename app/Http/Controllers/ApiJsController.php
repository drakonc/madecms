<?php

namespace App\Http\Controllers;

use App\Models\{Product, Favorite};
use Illuminate\Support\Facades\{Config, Auth};

class ApiJsController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['getProductsSection']);
    }

    public function getProductsSection($section ){
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

    public function postFavoriteAdd($object, $module){
        $query = Favorite::where('user_id',Auth::id())->where('module',$module)->where('object_id',$object)->count();
        if($query > 0):
            $data = ['status' => 'error', 'msg' => 'Este Item ya Esta en favoritos'];
            // TODO: Codigo para desmarcar favoritos -> no esta en el tutorial 
            /*
            * $result = Favorite::where('user_id',Auth::id())->where('module',$module)->where('object_id',$object)->first();
            * if($result->delete()):
            *    $data = ['status' => 'remove', 'msg' => 'Se quito de Favoritos'];
            * else:
            *    $data = ['status' => 'error', 'msg' => 'Error al quitar de favorito'];
            * endif;
            */
        else:
            $favorite = new Favorite;
            $favorite->user_id = Auth::id();
            $favorite->module = $module;
            $favorite->object_id = $object;
            if($favorite->save()):
                $data = ['status' => 'success', 'msg' => 'Se añadio a Favoritos'];
            else:
                $data = ['status' => 'error', 'msg' => 'Error al marcarce como favorito'];
            endif;
        endif;

        return response()->json($data);
    }
}
