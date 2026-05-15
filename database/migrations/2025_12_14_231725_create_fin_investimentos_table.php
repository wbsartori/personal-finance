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
        Schema::create('fin_investimentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->date('data_investimento');
            $table->string('tipo_investimento')->default('A')->nullable(); // Classe Enum TipoInvestimento
            $table->string('descricao')->nullable();
            $table->string('fonte_investimento');
            $table->decimal('valor', 15)->default(0);
            $table->foreign('users_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fin_investimentos');
    }
};
