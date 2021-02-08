<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome(){
        return view('admin.settings.settings');
    }

    public function postHome(Request $request){
        $data = $request->except(['_token']);
        if(!file_exists(config_path('madecms.php'))):
            fopen(config_path().'/madecms.php',"w");
        endif;

        $file = fopen(config_path().'/madecms.php',"w");
        fwrite($file,'<?php '.PHP_EOL);
        fwrite($file,PHP_EOL);
        fwrite($file,'    return [ '.PHP_EOL);
        foreach($data as $key => $value):
            if(is_null($value)):
                fwrite($file,'        \''.$key.'\' => \'\','.PHP_EOL);
            else:
                fwrite($file,'        \''.$key.'\' => \''.$value.'\','.PHP_EOL);
            endif;
        endforeach;
        fwrite($file,'    ] '.PHP_EOL);
        fwrite($file,PHP_EOL);
        fwrite($file,'?> '.PHP_EOL);
        fclose($file);
        return back()->with('message','Las Configuraciones Fueron Guardadas con Éxito')->with('typealert','success');
    }

}
