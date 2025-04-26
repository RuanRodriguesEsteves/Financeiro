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
        Schema::create('despesa', function(Blueprint $table){
            $table->id();
            $table->string('descricao', 50);
            $table->unsignedBigInteger('id_tipodespesa');
            $table->double('valor', 10, 2);
            $table->date('data');
            $table->unsignedBigInteger('id_mensalidadecartao')->nullable();
            $table->boolean('ativo')->default(true);

            $table->foreign('id_tipodespesa')->references('id')->on('tipodespesa')->onDelete('restrict');
            $table->foreign('id_mensalidadecartao')->references('id')->on('mensalidadecartao')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('despesa');
    }
};
