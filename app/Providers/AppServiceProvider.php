<?php

namespace App\Providers;

use App\Models\ModelCategoria;
use App\Models\ModelEntidadeJudicial;
use App\Models\ModelEstado;
use App\Models\ModelInfracao;
use App\Models\ModelMarca;
use App\Models\ModelProduto;
use App\Models\ModelSituacaoProcesso;
use App\Models\ModelTipoInfracao;
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
            /*SISTEMA DE GESTÃO DE INFRACTORES*/
            View::share('list_tipo_infracoes', ModelTipoInfracao::with('relation_infracoes')->get());
            View::share('list_situacao_processos', ModelSituacaoProcesso::all());
            View::share('list_entidades', ModelEntidadeJudicial::all());
            //View::share('list_tipo_infracoes', ModelTipoInfracao::all());
            View::share('list_infracoes', ModelInfracao::all());
        }
    }


    // 👉 Método para verificar se todas as tabelas existem
    private function tabelasExistem()
    {
        return Schema::hasTable('tb_tipo_infracoes')
            && Schema::hasTable('tb_entidades')
            && Schema::hasTable('tb_situacao_processos')
            && Schema::hasTable('tb_infracoes');
    }
}
