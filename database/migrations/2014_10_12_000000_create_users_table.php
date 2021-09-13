<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('state', ['En espera', 'Verificado', 'Rechazado']);
            $table->enum('tipo_documento', ['cedula_ciudadana', 'cedula_extranjera', 'pasaporte']);
            $table->bigInteger('num_documento');
            $table->string('ciudad_residencia');
            $table->enum('admin', [0, 1])->default(0)->comment('permite saber si un usuario es admin o no');
            $table->string('direccion_residencia')->nullable();
            $table->bigInteger('celular')->nullable();
            $table->string('banco'); //ESPEREMOS A VER SI VAN A HABER MAS BANCOS PARA AGREGAR UNA FOREIGN y UNA TABLA BANK
            $table->enum('tipo_cuenta', ['corriente', 'ahorro']);
            $table->string('num_cuenta');
            $table->longtext('photoDB')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
