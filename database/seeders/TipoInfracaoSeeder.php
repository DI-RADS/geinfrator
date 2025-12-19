<?php

namespace Database\Seeders;

use App\Models\ModelTipoInfracao;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class TipoInfracaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array com todas as tipos judiciais a serem cadastradas
        $tipos = [
            [
                'designacao' => 'Artigo'
            ],
            [
                'designacao' => 'Decreto'
            ],
        ];

        try {
            foreach ($tipos as $entidade) {
                ModelTipoInfracao::firstOrCreate(
                    ['designacao_tipo_infracao' => $entidade['designacao']]
                );
            }
        } catch (Exception $e) {
            Log::notice('Erro ao registar tipo de infração.', ['error' => $e->getMessage()]);
        }
    }
}
