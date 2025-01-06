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
        Schema::create('installment_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outputs_id')->nullable()->constrained('outputs')->name('fk_installment_payments_outputs_id');
            $table->string('description', 100);
            $table->decimal('value_of_installment', 15);
            $table->date('payment_date')->nullable();
            $table->string('status', 50)->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installment_payments');
    }
};
