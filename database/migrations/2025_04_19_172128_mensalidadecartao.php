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
        Schema::create('mensalidadecartao', function(Blueprint $table){
            $table->id();
            $table->string('descricao', 50);
            $table->double('valor', 10, 2);
            $table->date('datafechamento');
            $table->date('datavencimento');
            $table->date('mesreferencia');
            $table->unsignedBigInteger('id_cartao');
            $table->boolean('ativo')->default(true);

            $table->foreign('id_cartao')->references('id')->on('cartao')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensalidadecartao');
    }
};
