<?php

namespace App\Providers;

use App\Models\ModelCategoria;
use App\Models\ModelEstado;
use App\Models\ModelMarca;
use App\Models\ModelProduto;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define tamanho padrão das colunas string para evitar erro 1071
        Schema::defaultStringLength(191);

        // Super Admin tem acesso a todas as páginas
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });


        // --------------------------------------------------------------
        // 🔥  VARIÁVEIS GLOBAIS 
        // --------------------------------------------------------------

      // 🔥 Só executar se as tabelas EXISTIREM
        if ($this->tabelasExistem()) {
            View::share('list_categorias', ModelCategoria::all());
            View::share('list_estados', ModelEstado::all());
            View::share('list_marcas', ModelMarca::all());
            View::share('list_produtos', ModelProduto::all());
        }
    }
    

     // 👉 Método para verificar se todas as tabelas existem
    private function tabelasExistem()
    {
        return Schema::hasTable('tb_categorias')
            && Schema::hasTable('tb_estados')
            && Schema::hasTable('tb_marcas')
            && Schema::hasTable('tb_produtos');
    }
}
