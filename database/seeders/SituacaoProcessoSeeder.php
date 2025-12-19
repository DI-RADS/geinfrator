<?php

namespace Database\Seeders;

use App\Models\ModelSituacaoProcesso; // Model que representa a tabela de situações de processos
use Exception;                         // Para capturar erros durante a execução do seed
use Illuminate\Database\Seeder;        // Classe base de Seeders do Laravel
use Illuminate\Support\Facades\Log;    // Para registrar logs caso ocorra algum erro

class SituacaoProcessoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array com todas as situações de processos a serem cadastradas
        // Cada situação tem um nome (designacao) e uma descrição
        $situacoes = [
            [
                'designacao' => 'Arquivado',
                'descricao' => 'Processo arquivado sem pendências'
            ],
            [
                'designacao' => 'Aguarda Produção de Prova',
                'descricao' => 'Aguardando apresentação de provas ou documentos'
            ],
            [
                'designacao' => 'Concluso',
                'descricao' => 'Processo em análise pelo juiz para decisão'
            ],
            [
                'designacao' => 'Decidido',
                'descricao' => 'Processo com decisão final proferida'
            ],
            [
                'designacao' => 'Em Instrução',
                'descricao' => 'Fase de instrução, coletando provas e depoimentos'
            ],
            [
                'designacao' => 'Remetido',
                'descricao' => 'Processo remetido para outro órgão ou sector'
            ],
            [
                'designacao' => 'Remessa a Órgãos',
                'descricao' => 'Processo enviado a órgãos competentes.'
            ],
        ];

        // Tentativa de inserir cada situação no banco de dados
        // Caso ocorra algum erro, ele será capturado e registrado no log
        try {
            foreach ($situacoes as $situacao) {
                // firstOrCreate: busca pelo registro existente pelo campo designacao_situacao
                // Se não existir, cria um novo registro com designacao_situacao e descricao_situacao
                ModelSituacaoProcesso::firstOrCreate(
                    ['designacao_situacao' => $situacao['designacao']],
                    ['descricao_situacao' => $situacao['descricao']]
                );
            }
        } catch (Exception $e) {
            // Se ocorrer algum erro, registra no log do Laravel
            Log::notice('Erro ao cadastrar situação de processo.', ['error' => $e->getMessage()]);
        }
    }
}
