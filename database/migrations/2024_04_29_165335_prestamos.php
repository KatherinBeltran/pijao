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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->increments('id')->startingValue(101); // codigo prestamo
            $table->string('nom_cli_pre', 45); // nombre cliente prestamo
            $table->string('num_ced_cli_pre', 10); // numero cedula cliente prestamo
            $table->string('num_cel_cli_pre', 10); // numero celular cliente prestamo
            $table->string('dir_cli_pre', 45); // direccion cliente prestamo
            $table->unsignedInteger('bar_cli_pre'); // barrio cliente prestamo
            $table->datetime('fec_pre')->nullable(); // fecha prestamo
            $table->datetime('fec_pag_ant_pre')->nullable(); // fecha pago anticipado prestamo
            $table->string('pag_pre', 10)->nullable(); // cobros y/o pagos prestamo
            $table->integer('cuo_pre')->nullable(); // cuotas prestamo
            $table->integer('cap_pre')->nullable(); // capital prestamo
            $table->integer('int_pre')->nullable(); // interes prestamo
            $table->integer('tot_pre')->nullable(); // total prestamo
            $table->integer('val_cuo_pre')->nullable(); // valor cuota prestamo
            $table->integer('cuo_pag_pre')->nullable(); // cuotas pagadas prestamo
            $table->integer('val_pag_pre')->nullable(); // valor pagado prestamo
            $table->integer('sig_cuo_pre')->nullable(); // siguiente cuota prestamo
            $table->integer('cuo_pen_pre')->nullable(); // cuotas pendientes prestamo
            $table->integer('val_cuo_pen_pre')->nullable(); // valor cuotas pendientes prestamo
            $table->string('est_pag_pre')->nullable(); // estado pago prestamo
            $table->integer('dia_mor_pre')->nullable(); // dias mora prestamo
            $table->foreign('bar_cli_pre')->references('id')->on('barrios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};