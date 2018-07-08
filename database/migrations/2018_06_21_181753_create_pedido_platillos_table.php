<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoPlatillosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_platillos', function (Blueprint $table) {
            $table->increments('id');          
            $table->integer('idpedido')->unsigned();
            $table->foreign('idpedido')->references('id')->on('pedidos')->onDelete('cascade');
            $table->integer('idplatillo')->references('id')->on('platillos');
            $table->integer('cantidad');
            $table->double('precio',11,2);
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
        Schema::dropIfExists('pedido_platillos');
    }
}
