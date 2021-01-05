<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\PGallery;
use App\Models\Product;
use Validator,Str, Config,Image,Auth;

class ProductController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome($status){
        switch($status):
            case '0':
                $products = Product::with(['cat'])->where('status','0')->orderBy('id','desc')->paginate(25);
                break;
            case '1':
                $products = Product::with(['cat'])->where('status','1')->orderBy('id','desc')->paginate(25);
                break;
            case 'all':
                $products = Product::with(['cat'])->orderBy('id','desc')->paginate(25);
                break;
            case 'trash':
                $products = Product::with(['cat'])->onlyTrashed()->orderBy('id','desc')->paginate(25);
                break;
        endswitch;

        $data = ['products' => $products];
        return view('admin.products.home',$data);

    }

    public function getProductAdd(){
        $cats = Category::where('module','0')->pluck('name','id');
        $data = ['cats'=>$cats];
        return view('admin.products.add',$data);
    }

    public function getCategory(){
        $cats = Category::where('module','0')->get();
        return response()->json($cats);
    }

    public function postProductAdd(Request $request){
        $rules = [
            'name' => 'required',
            'img' => 'required|image',
            'price' => 'required',
            'content'=> 'required'
          ];

          $messages = [
            'name.required' => 'EL Nombre del Producto es Requerido',
            'img.required' => 'Seleccione una Imagen Destacada',
            'img.image' => 'El Archivo no es una Imagen',
            'price.required' => 'Ingrese el Precio del Producto',
            'content.required'=> 'Ingrese una Descripcion del Producto'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se Ha Producido Un Herror')->with('typealert','danger')->withInput();
        else:
            $path = '/'.date("Y-m-d");
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt,'',$request->file('img')->getClientOriginalName()));

            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            $file_file =$upload_path.'/'.$path.'/'.$filename;

            $product = new Product;
            $product->status = '0';
            $product->code = e($request->input('code'));
            $product->name = e($request->input('name'));
            $product->slug = Str::slug($request->input('name'));
            $product->category_id = $request->input('category');
            $product->file_path = date("Y-m-d");
            $product->image = $filename;
            $product->price = $request->input('price');
            $product->inventory = $request->input('inventory');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));

            if($product->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($file_file);
                    $img->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                endif;
                return redirect('admin/products/all')->with('message','Guardado con Éxito')->with('typealert','success');
            endif;
        endif;
    }

    public function getProductEdit($id){
        $product = Product::findOrFail($id);
        $cats = Category::where('module','0')->pluck('name','id');
        $data = ['cats'=>$cats,'product'=>$product];
        return view('admin.products.edit',$data);
    }

    public function postProductEdit(Request $request, $id){
        $rules = [
            'name' => 'required',
            'img' => 'image',
            'price' => 'required',
            'content'=> 'required'
          ];

          $messages = [
            'name.required' => 'EL Nombre del Producto es Requerido',
            'img.image' => 'El Archivo no es una Imagen',
            'price.required' => 'Ingrese el Precio del Producto',
            'content.required'=> 'Ingrese una Descripcion del Producto'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se Ha Producido Un Herror')->with('typealert','danger')->withInput();
        else:
            $product = Product::findOrFail($id);
            $product->status = $request->input('status');
            $product->code = e($request->input('code'));
            $product->name = e($request->input('name'));
            $product->category_id = $request->input('category');
            if($request->hasFile('img')):
                $path = date("Y-m-d");
                $fileExt = trim($request->file('img')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt,'',$request->file('img')->getClientOriginalName()));

                $fileOld = $upload_path.'/'.$product->file_path.'/'.$product->image;
                $fileOld_t = $upload_path.'/'.$product->file_path.'/t_'.$product->image;

                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;
                $product->file_path = date("Y-m-d");
                $product->image = $filename;
            endif;
            $product->price = $request->input('price');
            $product->inventory = $request->input('inventory');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));

            if($product->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($file_file);
                    $img->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    unlink($fileOld);
                    unlink($fileOld_t);
                endif;
                return back()->with('message','Actualizado con Éxito')->with('typealert','success');
            endif;
        endif;
    }

    public function postProductGaleryAdd(Request $request, $id){
        $rules = [
            'file_image' => 'required',
          ];

        $messages = [
            'file_image.required' => 'Seleccione una Imagen',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se Ha Producido Un Herror')->with('typealert','danger')->withInput();
        else:
            if($request->hasFile('file_image')):
                $path = date("Y-m-d");
                $fileExt = trim($request->file('file_image')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads.root');
                $name = Str::slug(str_replace($fileExt,'',$request->file('file_image')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;

                $g = new PGallery;
                $g->product_id = $id;
                $g->file_path = date("Y-m-d");
                $g->file_name = $filename;

                if($g->save()):
                    if($request->hasFile('file_image')):
                        $fl = $request->file_image->storeAs($path, $filename, 'uploads');
                        $img = Image::make($file_file);
                        $img->fit(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    endif;
                    return back()->with('message','Imagen Subida con Éxito')->with('typealert','success');
                endif;

            endif;
        endif;
    }

    public function getProductGaleryDelete($id,$gid){
        $g = PGallery::findOrFail($gid);
        $path = $g->file_path;
        $file = $g->file_name;
        $upload_path = Config::get('filesystems.disks.uploads.root');
        if($g->product_id != $id):
            return back()->with('message','La Imagen no se puede Eliminar')->with('typealert','danger');
        else:
            if($g->delete()):
                unlink($upload_path.'/'.$path.'/'.$file);
                unlink($upload_path.'/'.$path.'/t_'.$file);
                return back()->with('message','Imagen Eliminada con Éxito')->with('typealert','success');
            endif;
        endif;
    }

    public function getProductDelete($id) {
        $p = Product::findOrFail($id);
        if($p->delete()):
            return back()->with('message','Prodicto Enviado a la Papelera con Éxito')->with('typealert','success');
        endif;
    }

    public function getProductRestore($id){
        $p = Product::onlyTrashed()->where('id',$id)->first();
        if($p->restore()):
            return redirect('admin/product/'.$p->id.'/edit')->with('message','Prodicto Restaurado con Éxito')->with('typealert','success');
        endif;
    }

    public function postProducSearch(Request $request){

        $rules = [
            'search' => 'required',
            'filter' => 'required'
          ];

          $messages = [
            'search.required' => 'EL Nombre del Producto es Requerido',
            'filter.required' => 'Seleccione Tipo de Filtro'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se Ha Producido Un Herror')->with('typealert','danger')->withInput();
        else:
            switch($request->input('filter')):
                case '0':
                    if($request->input('status') == ''):
                        $products = Product::with(['cat'])->where('name','LIKE','%'.$request->input('search').'%')->orderBy('id','desc')->paginate(25);
                    else:
                        $products = Product::with(['cat'])->where('name','LIKE','%'.$request->input('search').'%')->where('status',$request->input('status'))->orderBy('id','desc')->paginate(25);
                    endif;
                    break;
                case '1':
                    $products = Product::with(['cat'])->where('code',$request->input('search'))->orderBy('id','desc')->paginate(25);
                    break;
            endswitch;
        endif;

        $data = ['products' => $products];
        return view('admin.products.home',$data);
    }

}
