<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Validator,Auth,Str,Config;

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

    public function postSliderAdd(Request $request){
        $rules = [
            'name' => 'required',
            'img' => 'required',
            'content' => 'required',
            'order' => 'required'
        ];

        $messages = [
            'name.required' => 'El Nombre es un Campo Requerido.',
            'img.required' => 'La Imagen es un Campo Requerido.',
            'content.required' => 'El Contenido es un Campo Requerido.',
            'order.required' => 'El Orden es un Campo Requerido.'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se Ha Producido Un Herror')->with('typealert','danger')->withInput();
        else:
            $path = date("Y-m-d");
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt,'',$request->file('img')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;

            $slider = new Slider();
            $slider->user_id = Auth::id();
            $slider->status = $request->input('visible');
            $slider->name = e($request->input('name'));
            $slider->file_path = $path;
            $slider->file_name = $filename;
            $slider->content = e($request->input('content'));;
            $slider->sorder =e($request->input('order'));;
            if($slider->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                endif;
                return back()->with('message','Guardado con Éxito')->with('typealert','success');
            else:
                return back()->with('message','Error al Guerdar los Datos')->with('typealert','danger');
            endif;
        endif;
    }
}
