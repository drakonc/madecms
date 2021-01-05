<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Validator,Str;

class CategoriesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome($module){
        $cats = Category::where('module',$module)->orderBy('name','Asc')->get();
        $data = ['cats'=>$cats];
        return view('admin.categories.home',$data);
    }

    public function postCategoryAdd(Request $request){
        $rules = [
            'name' => 'required',
            'icon' => 'required'
          ];

          $messages = [
            'name.required' => 'Se Requiere de un Nombre para la Categoria',
            'icon.required' => 'Se Requiere de un Icono para la Categoria',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se Ha Producido Un Herror')->with('typealert','danger');
        else:
            $cat = new Category;
            $cat->module = $request->input('modules');
            $cat->name = e($request->input('name'));
            $cat->slug = Str::slug($request->input('name'));
            $cat->icono = e($request->input('icon'));

            if($cat->save()):
                return back()->with('message','Guardado con Éxito')->with('typealert','success');
            endif;
        endif;
    }

    public function getCategoryEdit($id){
        $cat = Category::findOrFail($id);;
        $data = ['cat'=>$cat];
        return view('admin.categories.edit',$data);
    }

    public function postCategoryEdit(Request $request,$id){
        $rules = [
            'name' => 'required',
            'icon' => 'required'
          ];

          $messages = [
            'name.required' => 'Se Requiere de un Nombre para la Categoria',
            'icon.required' => 'Se Requiere de un Icono para la Categoria',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se Ha Producido Un Herror')->with('typealert','danger');
        else:
            $cat = Category::find($id);
            $cat->module = $request->input('modules');
            $cat->name = e($request->input('name'));
            $cat->slug = Str::slug($request->input('name'));
            $cat->icono = e($request->input('icon'));

            if($cat->save()):
                return redirect('/admin/categories/'.$cat->module)->with('message','Guardado con Éxito')->with('typealert','success');
            endif;
        endif;
    }

    public function getCategoryDelete($id){
        $products = Product::where('category_id',$id)->get();
        if($products->isEmpty()):
            $cat = Category::find($id);
            if($cat->delete()):
                return back()->with('message','Borrado con Éxito')->with('typealert','success');
            endif;
        else:
            return back()->with('message','No se Puede Borrar, Existen Productos en esta Categoria')->with('typealert','danger');
        endif;

    }

}
