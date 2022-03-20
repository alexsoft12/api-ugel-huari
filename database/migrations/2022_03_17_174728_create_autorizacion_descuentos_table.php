<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autorizacion_descuentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('codigo_tercero', 4);
            $table->double('descuento_mensual');
            $table->integer('nuemero_cuotas');
            $table->double('total_descuento');
            $table->date('fecha_compromiso');
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autorizacion_descuentos');
    }
};
