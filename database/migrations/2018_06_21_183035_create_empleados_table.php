<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
<<<<<<< HEAD
            $table->integer('id')->unsigned();
=======
            $table->integer('id');
>>>>>>> 8700e072751284091db0c1a28b61ee8c40250b4a
            $table->string('tipo_empleado',50);
            $table->double('salario',8,2);
            $table->date('fecha_inicio');
            $table->integer('dias_laborados');

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
        Schema::dropIfExists('empleados');
    }
}
