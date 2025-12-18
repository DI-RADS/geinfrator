<?php

namespace Database\Seeders;

use App\Models\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array com todos os status que queremos cadastrar
        $statuses = [
            'Ativo',
            'Inativo',
            'Aguardando Confirmação',
            'Spam',
        ];

        foreach ($statuses as $statusName) {
            try {
                // Cria o status se ainda não existir
                UserStatus::firstOrCreate(['name' => $statusName]);
            } catch (\Exception $e) {
                // Loga o erro caso algo falhe
                Log::notice("Status '{$statusName}' não cadastrado.", [
                    'error' => $e->getMessage()
                ]);
            }
        }
    }
}
