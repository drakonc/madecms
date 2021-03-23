<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Validator,Str,Config;

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
            $path = date("Y-m-d");
            $fileExt = trim($request->file('icon')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt,'',$request->file('icon')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;

            $cat = new Category;
            $cat->module = $request->input('modules');
            $cat->name = e($request->input('name'));
            $cat->slug = Str::slug($request->input('name'));
            $cat->file_path = $path;
            $cat->icono = $filename;

            if($cat->save()):
                if($request->hasFile('icon')):
                    $fl = $request->icon->storeAs($path, $filename, 'uploads');
                endif;
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
          ];

          $messages = [
            'name.required' => 'Se Requiere de un Nombre para la Categoria',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se Ha Producido Un Herror')->with('typealert','danger');
        else:
            $cat = Category::find($id);
            $cat->module = $request->input('modules');
            $cat->name = e($request->input('name'));
            $cat->slug = Str::slug($request->input('name'));
            if($request->hasFile('icon')):
                $path = date("Y-m-d");
                $fileExt = trim($request->file('icon')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt,'',$request->file('icon')->getClientOriginalName()));
                if(!is_null($cat->file_path) && !is_null($cat->icono)):
                    $fileOld = $upload_path.'/'.$cat->file_path.'/'.$cat->icono;
                endif;
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;
                $cat->file_path = date("Y-m-d");
                $cat->icono = $filename;
            endif;

            if($cat->save()):
                if($request->hasFile('icon')):
                    $fl = $request->icon->storeAs($path, $filename, 'uploads');
                    if(isset($fileOld)):
                        unlink($fileOld);
                    endif;
                endif;
                return back()->with('message','Guardado con Éxito')->with('typealert','success');
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
