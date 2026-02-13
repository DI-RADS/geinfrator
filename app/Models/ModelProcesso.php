<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelProcesso extends Model implements Auditable
{
    // tratamentos de auditoria
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes; // 👈 ATIVA O SOFT DELETE
    
    // Indicar o nome da tabela
    protected $table = 'tb_processos';

    //guardar todos dados
    protected $guarded = [];


    // Relação com o histórico de situações


    // Relação: situação atual do processo
    public function relation_situacaoAtual()
    {
        return $this->belongsTo(ModelSituacaoProcesso::class, 'situacao_id');
    }
    
    // Relação: todos os históricos de situação desse processo
    public function relation_historico_situacoes()
    {
        return $this->hasMany(ModelHistoricoSitProcesso::class, 'processo_id');
    }


    // Relação: entidade judicial do processo
    public function relation_entidade()
    {
        return $this->belongsTo(ModelEntidadeJudicial::class, 'entidade_id');
    }
}
