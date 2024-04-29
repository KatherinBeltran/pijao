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
        Schema::create('cuotas', function (Blueprint $table) {
            $table->increments('id'); // codigo cuota
            $table->unsignedInteger('pre_cuo'); // prestamo cuota
            $table->datetime('fec_cuo')->nullable();// fecha cuota
            $table->integer('val_cuo')->nullable(); // valor cuota
            $table->integer('tot_abo_cuo')->nullable(); // total abonado cuota
            $table->integer('sal_cuo')->nullable(); // saldo cuota
            $table->integer('num_cuo')->nullable(); // numero cuota
            $table->string('obs_cuo', 1000)->nullable(); // observacion cuota
            $table->foreign('pre_cuo')->references('id')->on('prestamos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuotas');
    }
};