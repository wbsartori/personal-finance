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
        Schema::create('fin_receitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('users_id');
            $table->string('descricao');
            $table->decimal('valor', 15 );
            $table->date('data_recebimento');
            $table->foreign('users_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fin_receitas');
    }
};
