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
        Schema::create('gastos', function (Blueprint $table) {
            $table->increments('id'); // codigo gasto
            $table->datetime('fec_gas'); // fecha gasto
            $table->integer('mon_gas'); // monto gasto
            $table->unsignedInteger('cat_gas'); // categoria gasto
            $table->foreign('cat_gas')->references('id')->on('categorias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gastos');
    }
};