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
            $table->increments('id');
            $table->timestamps();
            $table->string('tipo_contrato',50);
            $table->double('saldo',8,2);
            $table->string('distrito',50);
    
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
