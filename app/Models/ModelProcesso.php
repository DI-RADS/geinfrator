<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ModelProcesso extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;
    // Indicar o nome da tabela
    protected $table = 'tb_processos';

    //guardar todos dados
    protected $guarded = [];

    public function ralation_situacao_processo()
    {
        return $this->belongsTo(ModelSituacaoProcesso::class, 'situacao_id');
    }

    public function relation_entidade()  {
        return $this->belongsTo(ModelEntidadeJudicial::class, 'entidade_id'); 
    }
}
