<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelEstado extends Model
{
    //indicar a tabela
    protected $table ='tb_estados';

    //guardar todos campos
    protected $guarded = [];
}
