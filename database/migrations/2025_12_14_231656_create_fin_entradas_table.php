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
        Schema::create('fin_entradas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->string('observacoes')->nullable();
            $table->decimal('valor', 15)->nullable();
            $table->string('forma_pagamento')->default('D'); //D - Debito
            $table->string('tipo_lancamento')->default('A')->nullable(); // A - avista, R - recorrente ou P - parcelado
            $table->string('numero_parcela')->nullable();
            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable();
            $table->string('status')->default('P'); // P - Previsto, A - Atrasado ou C - Concluido
            $table->string('mes');
            $table->string('ano');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fin_entradas');
    }
};
