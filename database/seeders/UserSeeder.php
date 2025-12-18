<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Capturar possíveis exceções durante a execução do seeder. 
        try {
            // Verificar se o usuário está cadastrado no banco de dados
            if (!User::where('email', 'academiadesoftwares@gmail.com')->first()) {
                // Cadastrar o usuário
                $superAdmin = User::create([
                    'name' => 'Academia de Softwares',
                    'email' => 'academiadesoftwares@gmail.com',
                    'password' => bcrypt('123456a')
                ]);

                // Atribuir papel para o usuário
                $superAdmin->assignRole('Super Admin');
            }

            if (App::environment() !== 'production') {
                // Se não encontrar o registro com o e-mail, cadastra o registro no BD
                $admin = User::firstOrCreate(
                    ['email' => 'admin@gmail.com'],
                    [
                        'name' => 'Admin',
                        'email' => 'admin@gmail.com',
                        'password' => bcrypt('123456a')
                    ]
                );

                // Atribuir papel para o usuário
                $admin->assignRole('Admin');

                // Se não encontrar o registro com o e-mail, cadastra o registro no BD
                $gestor = User::firstOrCreate(
                    ['email' => 'gestor@gmail.com'],
                    ['name' => 'Gestor de Estoque', 
                    'email' => 'gestor@gmail.com', 
                    'password' => bcrypt('123456a')
                    ]
                );

                // Atribuir papel para o usuário
                $gestor->assignRole('Gestor');
                // $teacher->assignRole('Cliente');

                // Se não encontrar o registro com o e-mail, cadastra o registro no BD
                $funcionario = User::firstOrCreate(
                    ['email' => 'funcionario@gmail.com'],
                    ['name' => 'Funcionário', 
                    'email' => 'funcionario@gmail.com', 
                    'password' => bcrypt('123456a')
                    ]
                );

                // Atribuir papel para o usuário
                $funcionario->assignRole('Funcionário');

                // Se não encontrar o registro com o e-mail, cadastra o registro no BD
                $cliente = User::firstOrCreate(
                    ['email' => 'cliente@gmail.com'],
                    ['name' => 'Cliente', 
                    'email' => 'cliente@gmail.com', 
                    'password' => bcrypt('123456a')
                    ]
                );

                // Atribuir papel para o usuário
                $cliente->assignRole('Cliente');

                // Gerar nomes e e-mails aleatórios
                $faker = Faker::create();

                // Data de início (1 ano e 3 meses atrás)
                $startDate = Carbon::now()->subMonthsNoOverflow(15)->startOfMinute();

                // Data de fim (agora)
                $endDate = Carbon::now()->startOfMinute();

                // Número de usuários
                $totalUsers = 20;

                // Calcular o total de segundos entre as datas
                $totalSeconds = $endDate->timestamp - $startDate->timestamp;

                // Cadastrar usuários com papel "Cliente"
                for ($i = 0; $i < $totalUsers; $i++) {
                    // Distribuição progressiva (crescimento quadrático)
                    $progress = 1 - pow(($totalUsers - 1 - $i) / ($totalUsers - 1), 2);
                    //$progress = pow($i / ($totalUsers - 1), 2); // vai de 0 até 1 (quadraticamente)
                    $secondsToAdd = (int) round($progress * $totalSeconds);

                    // Criar a data progressiva crescente
                    $createdAt = (clone $startDate)->addSeconds($secondsToAdd);

                    $user = User::create([
                        'name' => $faker->name,
                        'email' => $faker->unique()->safeEmail, // Garantir que cada e-mail seja único.
                        'password' => bcrypt('123456a'), // Caso seja necessário forçar a criptografia da senha 'password' => bcrypt('123456A#'),
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt,
                    ]);
                    $user->assignRole('Cliente');
                }
            }
        } catch (Exception $e) {
            // Salvar log
            Log::notice('Usuário não cadastrado.', ['error' => $e->getMessage()]);
        }
    }
}
