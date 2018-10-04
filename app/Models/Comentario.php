<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comentario extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'idcomentario';
    protected $table = 'comentario';

    protected $fillable = [
        "comentario_text",
        "extension_archivo",
        "ruta_archivo",
        "post_idpost",
        "usuario_idusuario",
        "fecha_comentario",
        "key_redis_comentario",
        "tipo_id_post"
    ];

}