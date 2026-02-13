<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ModelHistoricoSitProcesso extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'tb_historico_situacao_processos';

    protected $guarded = [];

    public function relation_processo()
    {
        return $this->belongsTo(ModelProcesso::class, 'processo_id');
    }

    public function relation_situacao()
    {
        return $this->belongsTo(ModelSituacaoProcesso::class, 'situacao_processo_id');
    }
}
