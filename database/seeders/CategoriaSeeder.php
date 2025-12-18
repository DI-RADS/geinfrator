<?php

namespace Database\Seeders;

use App\Models\ModelCategoria;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            ModelCategoria::firstOrCreate(
                ['designacao_categoria' => 'Eletrônicos'], // busca pelo nome
                [
                    'descricao' => 'Produtos eletrônicos em geral',
                    'status' => true
                ]
            );

            ModelCategoria::firstOrCreate(
                ['designacao_categoria' => 'Roupas'], // busca pelo nome
                [
                    'descricao' => 'Vestuário masculino e feminino',
                    'status' => true
                ]
            );
            ModelCategoria::firstOrCreate(
                ['designacao_categoria' => 'Alimentos'], // busca pelo nome
                [
                    'descricao' => 'Produtos alimentícios e bebidas',
                    'status' => true
                ]
            );
            ModelCategoria::firstOrCreate(
                ['designacao_categoria' => 'Móveis'], // busca pelo nomeF
                [
                    'descricao' => 'Móveis para casa e escritório',
                    'status' => true
                ]
            );
            ModelCategoria::firstOrCreate(
                ['designacao_categoria' => 'Beleza'], // busca pelo nome
                [
                    'descricao' => 'Produtos de beleza e cuidados pessoais',
                    'status' => true
                ]
            );
        } catch (Exception $e) {
            Log::notice('Categoria não cadastrada.', ['error' => $e->getMessage()]);
        }
    }
}
