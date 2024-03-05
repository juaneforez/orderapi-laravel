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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->date('legalization_date')->comment('fecha legalización');
            $table->string('address', 50)->comment('direccion');
            $table->string('city', 50)->comment('cuidad');
            $table->foreignId('observation_id')->nullable()->constrained('observation')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreignId('causal_id')->nullable()->constrained('causal')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
