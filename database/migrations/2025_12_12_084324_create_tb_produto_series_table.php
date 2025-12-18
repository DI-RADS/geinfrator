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
        Schema::create('tb_produto_series', function (Blueprint $table) {
            $table->foreignId('produto_id')->constrained('tb_produtos')->onDelete('cascade');
            $table->string('numero_serie')->index();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->unique(['produto_id', 'numero_serie']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_produto_series');
    }
};
