<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ModelSituacaoProcesso extends Model implements Auditable
{
    // tratamentos de auditoria
    use \OwenIt\Auditing\Auditable;
    // Indicar o nome da tabela
    protected $table = 'tb_situacao_processos';

    //guardar todos dados
    protected $guarded = [];

    // Relação: uma situação pode ter vários processos
    public function relation_processo()
    {
        return $this->hasMany(ModelProcesso::class, 'situacao_id');
    }

     /**
     * Histórico de situações do processo
     * tb_historico_situacao_processos.processo_id
     */
    public function historicoSituacoes()
    {
        return $this->hasMany(ModelHistoricoSitProcesso::class, 'processo_id')
                    ->orderBy('created_at');
    }

    // Relação: uma situação pode ter vários históricos
    public function relation_historicos_situacao()
    {
        return $this->hasMany(ModelHistoricoSitProcesso::class, 'situacao_processo_id');
    }
}
