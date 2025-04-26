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
        Schema::create('renda', function(Blueprint $table) {
            $table->id();
            $table->string('descricao', 50);
            $table->unsignedBigInteger('id_tiporenda');
            $table->double('valor', 10, 2);
            $table->date('data');
            $table->boolean('ativo')->default(true);

            $table->foreign('id_tiporenda')->references('id')->on('tiporenda')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('renda');
    }
};
