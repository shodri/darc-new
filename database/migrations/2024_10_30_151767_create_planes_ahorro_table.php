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
        Schema::create('planes_ahorro', function (Blueprint $table) {
            $table->id();
            $table->string('pdaMarca');
            $table->string('pdaDescrip')->nullable();
            $table->integer('pdaCuotaBase')->nullable();
            $table->string('pdaVerCodigo')->nullable();
            $table->integer('pdaModCodigo')->nullable();
            $table->string('pdaModelo')->nullable();
            $table->string('pdaVersion')->nullable();
            $table->string('pdaNombre')->nullable();
            $table->string('pdaTipoPlan')->nullable();
            $table->text('pdaLegales')->nullable();
            $table->string('pdaVigencia')->nullable();
            $table->text('pdaCuotas')->nullable();
            $table->string('pdaUrl')->nullable();
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
        Schema::dropIfExists('plan_ahorros');
    }
};
