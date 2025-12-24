<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ModelInfracao extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;
    // Indicar o nome da tabela
    protected $table = 'tb_infracoes';

    //guardar todos dados
    protected $guarded = [];

    public function relation_infracao(){
        return $this->hasMany(ModelTipoInfracao::class, 'tipo_infracao_id');
        
    }


}
