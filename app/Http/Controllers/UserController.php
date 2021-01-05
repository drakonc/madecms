<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Validator,Str, Config,Image,Auth;

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
                $filename = rand(1,999).'_av-'.$name.'.'.$fileExt;
                $final_file =$upload_path.'/'.$path.'/'.$filename;
                $fileOld = null;
                $fileOld_t = null;

                $u = User::findOrFail(Auth::id());

                if(!is_null($u->avatar)):
                    $fileOld = $upload_path.'/'.$path.'/'.$u->avatar;
                    $fileOld_t = $upload_path.'/'.$path.'/t_'.$u->avatar;
                endif;

                $u->avatar = $filename;
                if($u->save()):
                    if($request->hasFile('file_avatar')):
                        $fl = $request->file_avatar->storeAs($path, $filename, 'uploads_users');
                        $img = Image::make($final_file);
                        $img->fit(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/t_'.$filename);
                        if(!is_null($fileOld) && !is_null($fileOld_t)):
                            unlink($fileOld);
                            unlink($fileOld_t);
                        endif;
                        return back()->with('message','Avatar Actualizado con Éxito')->with('typealert','success');
                    endif;
                endif;

                return $final_file;
            endif;
            return 'error';
        endif;
    }

}
