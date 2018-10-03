<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'idusuario';
    protected $table = 'usuario';

    protected $fillable = [
        "nick_usuario",
        "fecha_creacion",
        "nombre_usuario"
    ];

}