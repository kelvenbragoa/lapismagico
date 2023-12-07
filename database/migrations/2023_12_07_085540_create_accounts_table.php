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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('registration_id');
            $table->string('entinty');
            $table->string('reference');
            $table->integer('tax_id');
            $table->float('amount_to_pay',10,2);
            $table->float('amount_paid',10,2)->nullable();
            $table->date('expire_at');
            $table->date('payment_date')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
