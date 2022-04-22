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
        Schema::create('t_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('usuario');
            $table->boolean('ativo')->default(0);
            $table->string('nome')->nullable();
            $table->char('nick', 40)->nullable();
            $table->string('senha');
            $table->string('funcao');
            $table->char('celular', 15)->nullable();
            $table->string('email');
            $table->boolean('foto')->default(0);
            $table->string('nome_foto')->nullable();
            $table->boolean('permissao001')->default(0);
            $table->boolean('permissao002')->default(0);
            $table->boolean('permissao003')->default(0);
            $table->boolean('permissao004')->default(0);
            $table->boolean('permissao005')->default(0);
            $table->boolean('permissao006')->default(0);
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
        Schema::dropIfExists('t_usuarios');
    }
};
