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
        Schema::create('tb_marcas', function (Blueprint $table) {
            $table->id();
            $table->string('designacao_marca')->unique();
            $table->foreignId('categoria_id')->constrained('tb_categorias')->onDelete('cascade'); //Pegar o Id da pessoa fisica
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_marcas');
    }
};
