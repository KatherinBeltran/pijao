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
        Schema::create('capital', function (Blueprint $table) {
            $table->increments('id'); // codigo capital
            $table->integer('res_cap'); // capital restante
            $table->integer('des_cap'); // descuento capital
            $table->unsignedInteger('gas_cap')->nullable();  // categoria gasto capital
            $table->foreign('gas_cap')->references('id')->on('gastos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capital');
    }
};
