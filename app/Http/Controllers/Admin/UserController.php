<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(){
       $this->middleware('auth');
       $this->middleware('user.status');
       $this->middleware('user.permissions');
       $this->middleware('isadmin');
    }

    public function getUsers($status){
        if($status == 'all'):
            $users = User::orderBy('id','Desc')->paginate(30);
        else:
            $users = User::where('status',$status)->orderBy('id','Desc')->paginate(30);
        endif;
        $data = ['users' => $users];
        return view('admin.users.home',$data);
    }

    public function getUserEdit($id){
        $u = User::findOrFail($id);
        $data = ['u' => $u];
        return view('admin.users.edit',$data);
    }

    public function postUserEdit(Request $request, $id){
        $u = User::findOrFail($id);
        $u->role = $request->input('user_type');
        if($request->input('user_type') == "1"):
            if(is_null($u->permissinons)):
                $permissions = [
                    'dashboard' => true
                ];
                $permissions = json_encode($permissions);
                $u->permissions = $permissions;
            endif;
        else:
            $u->permissions = null;
        endif;
        if($u->save()):
            if($request->input('user_type') == "1"):
                return redirect('admin/user/'.$u->id.'/permissinons')->with('message','Rol Actualizado Satisfactoriamente')->with('typealert','success');
            else:
                return back()->with('message','Rol Actualizado Satisfactoriamente')->with('typealert','success');
            endif;
        endif;
    }

    public function getUserBanned($id){
        $u = User::findOrFail($id);
        if($u->status == "100"):
            $u->status = "1";
            $msg = "Usuario Activado Con Exito";
        else:
            $u->status = "100";
            $msg = "Usuario Susupendido Con Exito";
        endif;

        if($u->save()):
            return back()->with('message',$msg)->with('typealert','success');
        endif;
    }

    public function getUserPermissinons($id) {
        $u = User::findOrFail($id);
        $data = ['u' => $u];
        return view('admin.users.user_permissinons',$data);
    }

    public function postUserPermissinons(Request $request, $id){
        $u = User::findOrFail($id);
        $u->permissions = $request->except(['_token']);
        if($u->save()):
            $msg = 'Los Permisos del Usuario Fueron Actualizados con Éxito';
            return back()->with('message',$msg)->with('typealert','success');
        else:
            $msg = 'Los Permisos del Usuario no Pudieron ser Actualizados';
            return back()->with('message',$msg)->with('typealert','danger');
        endif;
    }
}
