<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipoComentario extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'idtipo_post';
    protected $table = 'tipo_post';

    protected $fillable = [
        "detalle_tipo", "created_at", "updated_at"
    ];

}