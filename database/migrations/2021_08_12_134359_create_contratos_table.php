<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->string('doc_cliente_firmado')->nullable();
            $table->string('doc_admin_firmado')->nullable();
            $table->enum('status', ['por_firmar', 'firma_cliente', 'firmado'])->default('por_firmar');
            $table->bigInteger('inversion_id')->unsigned();
            $table->foreign('inversion_id')->references('id')->on('inversiones');
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
        Schema::dropIfExists('contratos');
    }
}
