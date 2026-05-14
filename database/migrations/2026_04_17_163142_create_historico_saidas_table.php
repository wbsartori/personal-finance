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
        Schema::create('historico_saidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('fin_saida_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('fin_saida_id')->references('id')->on('fin_saidas');
            $table->string('type')->default('saidas');
            $table->string('descricao')->nullable();
            $table->decimal('valor', 15)->default(0);
            $table->string('forma_pagamento')->default('DEB');
            $table->string('tipo_lancamento')->default('A')->nullable();
            $table->integer('numero_parcela')->default(0)->nullable();
            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable();
            $table->string('status')->default('P');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_saidas');
    }
};
