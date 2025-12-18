<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ModelProduto extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  // Indicar o nome da tabela
  protected $table = 'tb_produtos';

  //guardar todos dados
  protected $guarded = [];

 
public function setPrecoProdutoAttribute($value)
{
    if ($value) {
        $valor = str_replace(['KZ$', '.', ' '], '', $value);
        $valor = str_replace(',', '.', $valor);
        $this->attributes['preco_produto'] = (float) $valor;
    }
}



  public function relation_series()
  {
    return $this->hasMany(ModelProdutoSerie::class, 'produto_id');
  }

    // Relacao marca e produto
  public function relation_marca()
  {
      return $this->belongsTo(ModelMarca::class, 'marca_id');
  }

    public function relation_estado()
  {
      return $this->belongsTo(ModelEstado::class, 'estado_id');
  }



}
