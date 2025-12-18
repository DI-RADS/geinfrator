<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ModelMarca extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    // Indicar o nome da tabela

    protected $table = 'tb_marcas';
    // Permite preencher todos os campos 
    protected $guarded = [];

    public function relation_categoria()
    {
        return $this->belongsTo(ModelCategoria::class, 'categoria_id');
    }
}
 