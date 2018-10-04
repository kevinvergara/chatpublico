<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use Exception;
use Log;
use App\Models\Usuario;

class HomeController extends BaseController
{
    public function index(){
        $data = array();
        return view("Home.login",$data);
    }

    public function postLogIn(Request $request){
        $data = array();
        $data = $request->all();

        $contador = Usuario::where("nick_usuario","=",(string)$data["nick"])->count();
        if($contador == 0){
            $usuario = new Usuario;
            $usuario->nick_usuario = $data["nick"];
            $usuario->fecha_creacion = date("Y-m-d H:i:s");
            $usuario->nombre_usuario = "";
            $usuario->save();

            Redis::set($data["token_"], $data["nick"]);
        }

        return '/home';
    }

    public function indexHome(){
        $data = array();
        
        return view("Home.index",$data);
    }
}