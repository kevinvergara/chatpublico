<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;
use Exception;

class HomeController
{
    public function index(){
        $data = array();
        //Redis::set('usuario', 'd');
        //var_dump(Redis::get('usuario'));
        return view("Home.index",$data);
    }

    public function LogIn(Request $request){
        $data = array();
        $data = $request->all();

        return "bien";
    }
}