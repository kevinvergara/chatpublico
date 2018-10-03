<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'idpost';
    protected $table = 'post';

    protected $fillable = [
        "texto",
        "fecha_post",
        "usuario_idusuario"
    ];

}