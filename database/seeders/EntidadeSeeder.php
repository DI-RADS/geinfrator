<?php

namespace Database\Seeders;

use App\Models\ModelEntidadeJudicial;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class EntidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array com todas as entidades judiciais a serem cadastradas
        $entidades = [
            [
                'designacao' => 'Procuradoria da República',
                'descricao' => 'Fiscal da lei, instaura ações penais, acompanha inquéritos.'
            ],
            [
                'designacao' => 'Tribunal Militar',
                'descricao' => 'Julga crimes militares, com juízes e procuradores próprios.'
            ],
            [
                'designacao' => 'Tribunal Civil',
                'descricao' => 'Julgam processos civis e criminais comuns (1.ª instância, apelação).'
            ],
            [
                'designacao' => 'Tribunal Administrativo',
                'descricao' => 'Julga conflitos administrativos e ações contra o Estado.'
            ],
            [
                'designacao' => 'Tribunal Constitucional',
                'descricao' => 'Verifica constitucionalidade de leis e decisões.'
            ],
            [
                'designacao' => 'Ministério da Justiça',
                'descricao' => 'Auxilia na execução de sentenças e garante funcionamento dos tribunais.'
            ],
        ];

        try {
            foreach ($entidades as $entidade) {
                ModelEntidadeJudicial::firstOrCreate(
                    ['designacao_entidade' => $entidade['designacao']],
                    ['descricao_entidade' => $entidade['descricao']]
                );
            }
        } catch (Exception $e) {
            Log::notice('Erro ao registar entidade judicial.', ['error' => $e->getMessage()]);
        }
    }
}
