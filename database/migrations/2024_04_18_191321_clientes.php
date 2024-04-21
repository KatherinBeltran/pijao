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
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id')->startingValue(101); // codigo cliente
            $table->string('nom_cli', 45); // nombre cliente
            $table->string('num_ced_cli', 10); // numero cedula cliente
            $table->string('num_cel_cli', 10); // numero celular cliente
            $table->string('dir_cli', 45); // direccion cliente
            $table->string('bar_cli', 45); // barrio cliente
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};