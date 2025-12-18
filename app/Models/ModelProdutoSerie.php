<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ModelProdutoSerie extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    // Indicar o nome da tabela
    protected $table = 'tb_produto_series';

    //
    protected $guarded = [];

    public function relation_produto()
    {
        return $this->belongsTo(ModelProduto::class, 'produto_id');
    }
}
