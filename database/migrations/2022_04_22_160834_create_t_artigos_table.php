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
            $table->boolean('ativo')->default(1);
            $table->integer('ordem')->default(0);
            $table->char('tipo')->default('I');
            $table->string('titulo')->nullable();
            $table->string('menu')->nullable();
            $table->string('url')->nullable();
            $table->string('title')->nullable();
            $table->string('link')->nullable();
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
