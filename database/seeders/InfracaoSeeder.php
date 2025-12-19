<?php

namespace Database\Seeders;

use App\Models\ModelInfracao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Exception;

class InfracaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Infrações do Artigo 5 da NRDM (tipo_infracao_id = 1)
            $artigos = [
                'Artigo 5 Nº 1 da NRDM',
                'Artigo 5 Nº 2 da NRDM',
                'Artigo 5 Nº 3 da NRDM',
                'Artigo 5 Nº 4 da NRDM',
                'Artigo 5 Nº 5 da NRDM',
                'Artigo 5 Nº 6 da NRDM',
                'Artigo 5 Nº 7 da NRDM',
                'Artigo 5 Nº 8 da NRDM',
                'Artigo 5 Nº 9 da NRDM',
                'Artigo 5 Nº 10 da NRDM',
                'Artigo 5 Nº 11 da NRDM',
                'Artigo 5 Nº 12 da NRDM',
                'Artigo 5 Nº 13 da NRDM',
                'Artigo 5 Nº 14 da NRDM',
                'Artigo 5 Nº 15 da NRDM',
                'Artigo 5 Nº 16 da NRDM',
                'Artigo 5 Nº 17 da NRDM',
                'Artigo 5 Nº 18 da NRDM',
                'Artigo 5 Nº 19 da NRDM',
                'Artigo 5 Nº 20 da NRDM',
                'Artigo 5 Nº 21 da NRDM',
                'Artigo 5 Nº 22 da NRDM',
                'Artigo 5 Nº 23 da NRDM',
                'Artigo 5 Nº 24 da NRDM',
                'Artigo 5 Nº 25 da NRDM',
            ];

            foreach ($artigos as $descricao) {
                ModelInfracao::firstOrCreate(
                    ['designacao_infracao' => $descricao, 'tipo_infracao_id' => 1],
                    ['descricao_infracao' => 'Norma Reguladora da Disciplina Militar']
                );
            }

            // Infrações do Decreto 33/91-Artigo 4º (tipo_infracao_id = 2)
            $decreto33 = [
                'Decreto 33/91-Artigo 4º -Nº 1',
                'Decreto 33/91-Artigo 4º -Nº 2',
                'Decreto 33/91-Artigo 4º -Nº 3',
                'Decreto 33/91-Artigo 4º -Nº 4',
                'Decreto 33/91-Artigo 4º -Nº 5',
                'Decreto 33/91-Artigo 4º -Nº 6',
                'Decreto 33/91-Artigo 4º -Nº 7',
                'Decreto 33/91-Artigo 4º -Nº 8',
                'Decreto 33/91-Artigo 4º -Nº 9',
                'Decreto 33/91-Artigo 4º -Nº 10',
                'Decreto 33/91-Artigo 4º -Nº 11',
                'Decreto 33/91-Artigo 4º -Nº 12',
            ];

            foreach ($decreto33 as $descricao) {
                ModelInfracao::firstOrCreate(
                    ['designacao_infracao' => $descricao, 'tipo_infracao_id' => 2],
                    ['descricao_infracao' => 'Infrações administrativas segundo o Decreto 33/91']
                );
            }
        } catch (Exception $e) {
            Log::error('Erro ao cadastrar infrações: ' . $e->getMessage());
        }
    }
}
