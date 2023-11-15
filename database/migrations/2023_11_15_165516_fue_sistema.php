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
        Schema::create('fue_sistema', function (Blueprint $table) {
            $table->increments('id');
            $table->string('entidad');
            $table->string('sector');
            $table->integer('año');
            $table->integer('desercion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fue_sistema');
    }
};
