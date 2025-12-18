<?php

namespace Database\Seeders;

use App\Models\ModelEstado;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Registrar marcas, evitando duplicidade
            ModelEstado::firstOrCreate(
                ['designacao_estado' => 'Novo'], // coluna que define a unicidade         
                ['descricao_estado' => 'Produto novo, nunca usado'], // coluna que define a unicidade         
            );
            ModelEstado::firstOrCreate(
                ['designacao_estado' => 'Usado'], // coluna que define a unicidade         
                ['descricao_estado' => 'Produto usado, em bom estado'], // coluna que define a unicidade         
            );
            ModelEstado::firstOrCreate(
                ['designacao_estado' => 'Recondicionado'], // coluna que define a unicidade         
                ['descricao_estado' => 'Produto usado, restaurado para venda'], // coluna que define a unicidade         
            );
            ModelEstado::firstOrCreate(
                ['designacao_estado' => 'Danificado'], // coluna que define a unicidade         
                ['descricao_estado' => 'Produto danificado, não vendido'], // coluna que define a unicidade         
            );
            ModelEstado::firstOrCreate(
                ['designacao_estado' => 'Devolvido'], // coluna que define a unicidade         
                ['descricao_estado' => 'Produto devolvido pelo cliente'], // coluna que define a unicidade         
            );
            ModelEstado::firstOrCreate(
                ['designacao_estado' => 'Em Manutenção'], // coluna que define a unicidade         
                ['descricao_estado' => 'Produto em manutenção ou reparo'], // coluna que define a unicidade         
            );
            ModelEstado::firstOrCreate(
                ['designacao_estado' => 'Avariado'], // coluna que define a unicidade         
                ['descricao_estado' => 'Produto com defeito parcial'], // coluna que define a unicidade         
            );
            ModelEstado::firstOrCreate(
                ['designacao_estado' => 'Perdido'], // coluna que define a unicidade         
                ['descricao_estado' => 'Produto extraviado ou perdido em estoque'], // coluna que define a unicidade         
            );
            ModelEstado::firstOrCreate(
                ['designacao_estado' => 'Em Garantia'], // coluna que define a unicidade         
                ['descricao_estado' => 'Produto dentro do período de garantia'], // coluna que define a unicidade         
            );
            ModelEstado::firstOrCreate(
                ['designacao_estado' => 'Bloqueado'], // coluna que define a unicidade         
                ['descricao_estado' => 'Produto bloqueado por algum motivo administrativo'], // coluna que define a unicidade         
            );

        
          
        } catch (Exception $e) {
            Log::notice('Estado não cadastrada.', ['error' => $e->getMessage()]);
        }
    }
}
