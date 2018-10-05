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
use App\Models\Post;
use App\Models\Comentario;
use App\Models\TipoComentario;
use App\Events\eventTrigger;
use App\Listeners\popUpBox;

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

    public function cargarPosts(Request $request){
        $data = array();
        $data = $request->all();

        $post = Post::join('usuario', 'post.usuario_idusuario', '=', 'usuario.idusuario')
                    ->orderBy("post.idpost","ASC")
                    ->select("post.idpost as id_post",DB::raw("CONCAT(post.idpost,'.- usuario: ',usuario.nick_usuario,' post: ',SUBSTRING(post.texto,1,30),' ...') as post"))
                    ->get();

        return view("Home.partials.select_post",array("posts" => $post))->render();
    }

    public function cargarChat(Request $request){
        $data = array();
        $data = $request->all();

        $post = Post::find($data["id_post"]);

        $usuario = Usuario::find($post->usuario_idusuario);
        
        $chat = Comentario::join('usuario', 'comentario.usuario_idusuario', '=', 'usuario.idusuario')
                        ->where("comentario.post_idpost",$post->idpost)
                        ->orderBy("comentario.fecha_comentario","DESC")
                        ->select(
                            "comentario.idcomentario as id_comentario",
                            "comentario.comentario_text as comentario",
                            "comentario.extension_archivo as extension_arch",
                            "comentario.ruta_archivo as ruta_storage",
                            "comentario.usuario_idusuario as id_user",
                            "comentario.fecha_comentario as fecha",
                            "comentario.key_redis_comentario as key_redis",
                            "comentario.tipo_id_post as tipo_comentario",
                            "usuario.nick_usuario as nick_user"
                        )
                        ->get();

        return view("Home.partials.chat_post", array(
            "post" => $post,
            "usuario_post" => $usuario,
            "chat" => $chat 
            ))->render();
    }

    public function guardarComentario(Request $request){
        $data = array();
        $data = $request->all();
        log::info($data);
        $tipos_videos = ["avi","mov","mp4","flv","wmv",];
        $tipos_imagenes = ["jpeg","jfif","exif","tiff","gif","bmp","png","ppm","pgm","pbm","pnm","webp","bat","bpg"];

        $tipo_post = 1;
        $extension = "";
        $path_file = "";

        $nick = Redis::get($data["_token"]);
        $usuario = Usuario::where("nick_usuario","=",(string)$nick)->first();
        if($usuario->count() != 0){
            if($request->file("archivo")){
                $path_file = Storage::put("public", $request->file("archivo"), 'public');
                $extension = strtolower($data["archivo"]->extension());
                
                $path_file = str_replace("public/","",$path_file);

                if(in_array($extension,$tipos_imagenes)){
                    $tipo_post = 2;
                }else if(in_array($extension,$tipos_videos)){
                    $tipo_post = 3;
                }         
            }

            $key = date("YmdHis").$usuario->idusuario.$data["id_post"];
            Redis::set($key,isset($data["comentario-text"]) ? $data["comentario-text"] : "sin comentario");
            
            $new_post = new Comentario;
            $new_post->comentario_text = isset($data["comentario-text"]) ? $data["comentario-text"] : "sin comentario" ;
            $new_post->extension_archivo = $extension;
            $new_post->ruta_archivo = $path_file;
            $new_post->post_idpost = $data["id_post"];
            $new_post->usuario_idusuario = $usuario->idusuario;
            $new_post->fecha_comentario = date("Y-m-d H:i:s");
            $new_post->key_redis_comentario = $key;
            $new_post->tipo_id_post = $tipo_post;
            $new_post->save();

            event(new eventTrigger((string)$nick ,(string) $data["id_post"]));
        }else{
            return "sesión inválida";
        }


        return "exito";
    }

    public function recargarChat(Request $request){
        $data = array();
        $data = $request->all();

        $post = Post::find($data["id_post"]);

        $chat = Comentario::join('usuario', 'comentario.usuario_idusuario', '=', 'usuario.idusuario')
                        ->where("comentario.post_idpost",$post->idpost)
                        ->orderBy("comentario.fecha_comentario","DESC")
                        ->select(
                            "comentario.idcomentario as id_comentario",
                            "comentario.comentario_text as comentario",
                            "comentario.extension_archivo as extension_arch",
                            "comentario.ruta_archivo as ruta_storage",
                            "comentario.usuario_idusuario as id_user",
                            "comentario.fecha_comentario as fecha",
                            "comentario.key_redis_comentario as key_redis",
                            "comentario.tipo_id_post as tipo_comentario",
                            "usuario.nick_usuario as nick_user"
                        )
                        ->get();

        return view("Home.partials.chat_reload",array(
            "chat" => $chat
            ))->render();
    }

    public function crearPostVista(Request $request){
        $data = array();
        $data = $request->all();

        $nick = Redis::get($data["_token"]);
        $usuario = Usuario::where("nick_usuario","=",(string)$nick)->first();

        return view("Home.partials.crear_post",array("usuario" => $usuario))->render();
    }

    public function guardarPost(Request $request){
        $data = array();
        $data = $request->all();

        $nick = Redis::get($data["_token"]);
        $usuario = Usuario::where("nick_usuario","=",(string)$nick)->first();

        if($usuario->count() != 0){
            $new_post = new Post;
            $new_post->texto = $data["comentario-text"];
            $new_post->fecha_post = date("Y-m-d H:i:s");
            $new_post->usuario_idusuario  = $usuario->idusuario;
            $new_post->save();
        }else{
            return "error";
        }

        return $new_post->idpost;
    }

}