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
        Schema::create('banco', function(Blueprint $table){
            $table->id(); // Equivale ao SERIAL PRIMARY KEY
            $table->string('descricao', 50); // VARCHAR(50) NOT NULL
            $table->boolean('ativo')->default(true); // BOOLEAN NOT NULL DEFAULT TRUE
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banco');
    }
};
