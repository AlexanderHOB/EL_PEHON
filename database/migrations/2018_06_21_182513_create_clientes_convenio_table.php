<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesConvenioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_convenio', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->timestamps();
            $table->string('tipo_contrato',50);
            $table->double('saldo',11,2);
            $table->string('distrito',50);
            $table->foreign('id')->references('id')->on('personas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes_convenio');
    }
}
