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
        Schema::create('t_conteudos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_artigo');
            $table->boolean('ativo')->default(0);
            $table->integer('ordem')->default(0);
            $table->char('tipo', 1)->default('T');
            $table->string('nome')->nullable();
            $table->mediumText('conteudo');
            $table->timestamps();

            $table->foreign('id_artigo')->references('id')->on('t_artigos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_conteudos');
    }
};
