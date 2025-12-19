<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ModelSituacaoProcesso extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;
    // Indicar o nome da tabela
    protected $table = 'tb_situacao_processos';

    //guardar todos dados
    protected $guarded = [];


    public function relation_situacao_processo()
    {
        return $this->hasMany(ModelSituacaoProcesso::class, 'situacao_id');
    }
}
