<?php

namespace Database\Seeders;

use App\Models\ModelMarca;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class MarcaSeeder extends Seeder
{
    public function run(): void
    {
        try {
            // Lista de marcas com o ID da categoria correspondente
            $marcas = [
                // categoria electronicos
                ['Samsung', 1],
                ['Apple', 1],
                ['Sony', 1],
                ['LG', 1],
                ['Panasonic', 1],
                ['Xiaomi', 1],

                // categoria Roupas
                ['Nike', 2],
                ['Adidas', 2],
                ['Puma', 2],

                // categoria Alimentos
                ['Nestlé', 3],
                ['Coca-Cola', 3],
                ['Pepsi', 3],

                // categoria Móveis
                ['IKEA', 4],
                ['Tok&Stok', 4],
                ['Rivatti', 4],

                // categoria Beleza
                ['Loréal', 5],
                ['Nivea', 5],
                ['Avon', 5],
            ];

            foreach ($marcas as [$marcaNome, $categoriaId]) {
                ModelMarca::firstOrCreate([
                    'designacao_marca' => $marcaNome,
                    'categoria_id'     => $categoriaId,
                ]);
            }
        } catch (Exception $e) {
            Log::error('Erro ao cadastrar marca.', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
