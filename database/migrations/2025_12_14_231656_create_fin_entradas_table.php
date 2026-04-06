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
            $table->string('descricao')->nullable();
            $table->bigInteger('valor')->default(0);
            $table->string('forma_pagamento')->default('DEB'); //Classe Enum FormaPagamento
            $table->string('tipo_lancamento')->default('A')->nullable(); // Classe Enum TipoLancamento
            $table->integer('numero_parcela')->default(0)->nullable();
            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable();
            $table->string('status')->default('P'); // Classe Enum Status
            $table->foreign('users_id')->references('id')->on('users');
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
