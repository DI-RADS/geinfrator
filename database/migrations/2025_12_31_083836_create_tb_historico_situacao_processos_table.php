<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
    */
    public function up(): void
    {
        Schema::create('tb_historico_situacao_processos', function (Blueprint $table) {
            $table->id();
            $table->text('motivo_alteracao')->nullable();
            $table->date("data_alt_situacao")->nullable();
            $table->foreignId('processo_id')->constrained('tb_processos')->onDelete('cascade');
            $table->foreignId('situacao_processo_id')->constrained('tb_situacao_processos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('tb_historico_situacao_processos');
    }
};
