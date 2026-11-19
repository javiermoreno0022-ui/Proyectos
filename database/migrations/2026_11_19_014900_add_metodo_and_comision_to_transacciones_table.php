<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega el método de pago y la comisión.
     */
    public function up(): void
    {
        Schema::table('transacciones', function (Blueprint $table) {
            $table->string('metodo')->default('tarjeta');
            $table->decimal('comision', 8, 2)->default(0);
        });
    }

    /**
     * Revierte los cambios realizados.
     */
    public function down(): void
    {
        Schema::table('transacciones', function (Blueprint $table) {
            $table->dropColumn(['metodo', 'comision']);
        });
    }
};