<?php

namespace App\Http\Controllers;

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
                $path = date("Y-m-d");
                $fileExt = trim($request->file('file_avatar')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.uploads_users.root');
                $name = Str::slug(str_replace($fileExt,'',$request->file('file_avatar')->getClientOriginalName()));
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $final_file =$upload_path.'/'.$path.'/'.$filename;



                return $final_file;
            endif;
            return 'error';
        endif;
    }

}
