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
        Schema::create('t_artigos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pai')->default(0);
            $table->integer('id_menu')->default(0);
            $table->boolean('ativo')->default(0);
            $table->integer('ordem')->default(0);
            $table->char('tipo')->default('M'); // (M)enu - (S)ubmenu - (A)rtigo - (X)sistema
            $table->char('destino')->default('I'); // (I)nterno - (E)xterno
            $table->string('titulo')->nullable(true);
            $table->string('menu')->nullable(true);
            $table->string('url')->nullable(true);
            $table->string('title')->nullable(true);
            $table->string('link')->nullable(true);
            $table->mediumText('keywords');
            $table->mediumText('descricao');
            $table->boolean('principal')->default(0);
            $table->boolean('titulo_ativo')->default(1);
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
        Schema::dropIfExists('t_artigos');
    }
};
