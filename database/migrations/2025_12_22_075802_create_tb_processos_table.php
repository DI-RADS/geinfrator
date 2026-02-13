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
        Schema::create('tb_processos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_processo')->unique();
            $table->text('descricao_processo')->nullable();
            $table->year('ano_instrucao')->nullable();
            $table->dateTime('data_entrada')->nullable();
            $table->foreignId('situacao_id')->constrained('tb_situacao_processos')->onDelete('cascade'); //chave estrangeira
            $table->foreignId('entidade_id')->constrained('tb_entidades')->onDelete('cascade'); // Relaciona com o tipo de entidades
           // $table->foreignId('infracao_id')->constrained('tb_infracoes')->onDelete('cascade');
            $table->timestamps();
           $table->softDeletes(); // 🔥 Para ocultar o processo apagado das listagens normais
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_processos');
    }
};
