<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ModelEntidadeJudicial extends Model implements Auditable
{
    // //
    use \OwenIt\Auditing\Auditable;
    // Indicar o nome da tabela
    protected $table = 'tb_entidades';

    //guardar todos dados
    protected $guarded = [];

    public function ralation_processo() {
        return $this->hasMany(ModelProcesso::class, 'processo_id');
        
    }

}
