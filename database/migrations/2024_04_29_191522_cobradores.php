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
        Schema::create('cobradores', function (Blueprint $table) {
            $table->increments('id'); // codigo cobrador
            $table->string('nom_cob', 45); // nombre cobrador
            $table->string('num_ced_cob', 10); // numero cedula cobrador
            $table->string('num_cel_cob', 10); // numero celular cobrador
            $table->string('cor_ele_cob', 45); // correo electronico cobrador
            $table->string('dir_cob', 45); // direccion cobrador
            $table->unsignedInteger('bar_cob'); // barrio cobrador
            $table->unsignedInteger('zon_cob'); // zona cobrador
            $table->foreign('bar_cob')->references('id')->on('barrios');
            $table->foreign('zon_cob')->references('id')->on('zonas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cobradores');
    }
};