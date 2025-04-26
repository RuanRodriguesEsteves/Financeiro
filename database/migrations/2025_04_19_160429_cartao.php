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
        Schema::create('cartao', function(Blueprint $table){
            $table->id();
            $table->string('descricao', 50);
            $table->boolean('ativo')->default(true);
            $table->unsignedBigInteger('id_banco');

            $table->foreign('id_banco')->references('id')->on('banco')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartao');
    }
};
