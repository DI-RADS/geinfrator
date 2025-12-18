<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ModelCategoria extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    // Indicar o nome da tabela
    protected $table = 'tb_categorias';
    // Permite preencher todos os campos 
    protected $guarded = [];

    public function relation_marcas() {
    return $this->hasMany(ModelMarca::class, 'categoria_id');
}
}
