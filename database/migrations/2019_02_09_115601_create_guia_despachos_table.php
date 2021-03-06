<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuiaDespachosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guia_despachos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cod_seguimiento');
            $table->integer('id_user')->unsigned(); //saber que usuario registro el proveedor
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->integer('id_empresa')->unsigned(); //saber que usuario registro el proveedor
            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');
            $table->integer('id_empresa_despacho')->unsigned(); //saber que usuario registro el proveedor
            $table->foreign('id_empresa_despacho')->references('id')->on('empresa_despachos')->onDelete('cascade');
            $table->string('recibe');
            $table->string('observaciones')->nullable();
            $table->string('firma');
            $table->string('firma_receptor')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('guia_despachos');
    }
}
