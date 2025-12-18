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
        Schema::create('tb_produtos', function (Blueprint $table) {
            $table->id();
            $table->string('designacao_produto');
            $table->text('descricao_produto')->nullable();
            $table->float("preco_produto")->nullable();
            $table->integer("quantidade_produto")->nullable();

            //relacionamentos
           // $table->foreignId('categoria_id')->constrained('tb_categorias')->onDelete('cascade');
            $table->foreignId('marca_id')->constrained('tb_marcas')->onDelete('cascade');
            $table->foreignId('estado_id')->constrained('tb_estados')->onDelete('cascade');

            // Status ENUM
            // $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            // Status simples (ativo(true)/inativo(false))
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_produtos');
    }
};
