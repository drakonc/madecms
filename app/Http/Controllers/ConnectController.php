<?php

namespace App\Http\Controllers;

use Validator,Hash,Auth,Mail,PDF;
use App\Mail\UserSendRecover;
use Illuminate\Http\Request;
use App\Models\User;
use Cookie;

class ConnectController extends Controller
{

    public function __construct(){
        $this->middleware('guest')->except(['getLogout','getRecover','postRecover']);
    }

    public function getPDF(){
        $pdf = PDF::loadView('pruebaPDF');
        return $pdf->stream('demo.pdf');
    }

    public function getLogin(){
        return view('connect.login');
    }

    public function postLogin(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8',
          ];

          $messages = [
            'email.required' => 'Su Correo Electrónico es Requerido.',
            'email.email' => 'El Formato de su Correo Electrónico es Invalido.',
            'password.required' => 'Por Favor Escriba una Contraseña.',
            'password.min' => 'La Contraseña Debe Tener al Menos 8 Caracteres.',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se Ha Producido Un Herror')->with('typealert','danger');
        else:
            if( Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')],false)):
                if(Auth::user()->status == '100' ):
                    return redirect('/logout');
                else:
                    return redirect('/');
                endif;
            else:
                return back()->with('message','Correo Electrónico o Contraseña Errónea.')->with('typealert','danger')->withInput();
            endif;
        endif;

    }

    public function getRegister(){
        return view('connect.register');
    }

    public function postRegister(Request $request){
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:App\Models\User,email',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
        ];

        $messages = [
            'name.required' => 'Su Nombre es Requerido.',
            'lastname.required' => 'Su Apellido es Requerido.',
            'email.required' => 'Su Correo Electrónico es Requerido.',
            'email.email' => 'El Formato de su Correo Electrónico es Invalido.',
            'email.unique' => 'Ya Existe un Usuario Registrado con ese Correo Electrónico.',
            'password.required' => 'Por Favor Escriba una Contraseña.',
            'password.min' => 'La Contraseña Debe Tener al Menos 8 Caracteres.',
            'cpassword.required' => 'Es Necesario Confirmar la Contraseña.',
            'cpassword.min' => ' La Confirmación de la Contraseña Debe Tener al Menos 8 Caracteres.',
            'cpassword.same' => 'La Contraseñas No Coinciden.',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se Ha Producido Un Herror')->with('typealert','danger')->withInput();
        else:
            $user = new User;
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->email = e($request->input('email'));
            $user->password = Hash::make($request->input('password'));
            $user->avatar = null;

            if($user->save()):
                return redirect('/login')->with('message','Su Usuario se Creó con Éxito, ahora puede Iniciar Sesión.')->with('typealert','success');;
            endif;

        endif;

    }

    public function getLogout(){
        $status = Auth::user()->status;
        Auth::logout();
        if($status == '100' ):
            return redirect('/login')->with('message','Su Usuario Fue Suspendido.')->with('typealert','danger');
        else:
            return redirect('/');
        endif;
    }

    public function getRecover(){
        return view('connect.recover');
    }

    public function postRecover(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'cpassword' => 'required|min:8|same:password'
        ];

        $messages = [
            'email.required' => 'Su Correo Electrónico es Requerido.',
            'email.email' => 'El Formato de su Correo Electrónico es Invalido.',
            'password.required' => 'Por Favor Escriba una Contraseña.',
            'password.min' => 'La Contraseña Debe Tener al Menos 8 Caracteres.',
            'cpassword.required' => 'Es Necesario Confirmar la Contraseña.',
            'cpassword.min' => ' La Confirmación de la Contraseña Debe Tener al Menos 8 Caracteres.',
            'cpassword.same' => 'La Contraseñas No Coinciden.',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se Ha Producido Un Herror')->with('typealert','danger')->withInput();
        else:
            $user = User::where('email',$request->input('email'))->count();
            if($user == '1'):
                $user = User::where('email',$request->input('email'))->first();
                $user->password = Hash::make($request->input('password'));
                if($user->save()):
                    return redirect('/login')->with('message','Su Contraseña se Restauro con Éxito, ahora puede Iniciar Sesión.')->with('typealert','success');;
                else:
                    return back()->withErrors($validator)->with('message','Ocurrio un Error al tratar de Restaurara la Contraseña')->with('typealert','danger')->withInput();
                endif;
            else:
                return back()->withErrors($validator)->with('message','Este Correo Electronico No Existe')->with('typealert','danger')->withInput();
            endif;
        endif;
    }

}
