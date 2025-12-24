<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ModelTipoInfracao extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    // Indicar o nome da tabela
    protected $table = 'tb_tipo_infracoes';

    //guardar todos dados
    protected $guarded = [];

    public function relation_infracoes()
    {
        return $this->belongsTo(ModelInfracao::class, 'tipo_infracao_id');
    }
}
