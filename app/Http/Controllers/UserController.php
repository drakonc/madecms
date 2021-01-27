<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Validator,Str, Config,Image,Auth,Hash;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getAccountEdit(){
        return view('user.account_edit');
    }

    public function postAccountEditAvatar(Request $request){
        $rules = [
            'file_avatar' => 'required',
          ];

        $messages = [
            'file_avatar.required' => 'Seleccione una Imagen',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se Ha Producido Un Herror')->with('typealert','danger')->withInput();
        else:;
            if($request->hasFile('file_avatar')):
                $path = Auth::id();
                $fileExt = trim($request->file('file_avatar')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads_users.root');
                $name = Str::slug(str_replace($fileExt,'',$request->file('file_avatar')->getClientOriginalName()));
                $filename = rand(1,999).'_avt-'.$name.'.'.$fileExt;
                $final_file =$upload_path.'/'.$path.'/'.$filename;
                $fileOld = null;

                $u = User::findOrFail(Auth::id());

                if(!is_null($u->avatar)):
                    $fileOld = $upload_path.'/'.$path.'/'.$u->avatar;
                endif;

                $u->avatar = 'avt_'.$filename;
                if($u->save()):
                    if($request->hasFile('file_avatar')):
                        $fl = $request->file_avatar->storeAs($path, $filename, 'uploads_users');
                        $img = Image::make($final_file);
                        $img->fit(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/avt_'.$filename);
                        unlink($final_file);
                        if(!is_null($fileOld)):
                            unlink($fileOld);
                        endif;
                        return back()->with('message','Avatar Actualizado con Éxito')->with('typealert','success');
                    endif;
                endif;

                return $final_file;
            endif;
            return 'error';
        endif;
    }

    public function postAccountEditPassword(Request $request){
        $rules = [
            'apassword' => 'required|min:8',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
        ];

        $messages = [
            'apassword.required' => 'Su Contraseña Actual es Requerido.',
            'apassword.min' => 'Su Contraseña Actual debe tener al Menos 8 Caracteres.',
            'password.required' => 'Por Favor Escriba una Contraseña Nueva.',
            'password.min' => 'La Contraseña Debe Tener al Menos 8 Caracteres.',
            'cpassword.required' => 'Es Necesario Confirmar la Contraseña Nueva.',
            'cpassword.min' => ' La Confirmación de la Contraseña Debe Tener al Menos 8 Caracteres.',
            'cpassword.same' => 'La Contraseñas No Coinciden.',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se Ha Producido Un Herror')->with('typealert','danger')->withInput();
        else:
            $u = User::findOrFail(Auth::id());
            if(Hash::check($request->input('apassword'),$u->password)):
                $u->password = Hash::make($request->input('password'));
                if($u->save()):
                    return back()->with('message','Su Contraseña Se Actualizo Correctamente')->with('typealert','success');
                else:
                    return back()->with('message','Error al Actualizar Contraseña')->with('typealert','danger');
                endif;
            else:
                return back()->with('message','Su Contraseña Actual es Errónea')->with('typealert','danger');
            endif;
        endif;

    }

    public function postAccountEditInfo(Request $request){
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'phone' => 'required|min:7',
            'birthday' => 'required',
            'gender' => 'required'
        ];

        $messages = [
            'name.required' => 'El Nomnre es Requerido',
            'lastname.required' => 'El Apellido es Requeridouired',
            'phone.required' => 'El Telefono es Requerido',
            'phone.min' => 'El Telefono minimo tiene 7 caracteras',
            'birthday.required' => 'El Cumpleaños es Requerido',
            'gender.required' => 'El Genero es Requerido'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se Ha Producido Un Herror')->with('typealert','danger')->withInput();
        else:
            $u = User::findOrFail(Auth::id());
            $u->name = e($request->input('name'));
            $u->lastname = e($request->input('lastname'));
            $u->phone = e($request->input('phone'));
            $u->birthday = $request->input('birthday');
            $u->gender = $request->input('gender');

            if($u->save()):
                return back()->with('message','Sus Datos Se Actualizaron Correctamente')->with('typealert','success');
            else:
                return back()->with('message','Error al Actualizar tus Datos')->with('typealert','danger');
            endif;
        endif;
    }

}
