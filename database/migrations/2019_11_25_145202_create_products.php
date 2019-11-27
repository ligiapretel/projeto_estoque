<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 300);
            $table->string('description', 500);
            $table->integer('quantity');
            // No float, os números indicam a quantidade de casas antes da vírgula e depois da vírgula
            $table->float('price',8,2);
            // Antes de criar a foreign key, eu crio a coluna que será foreign key. Precisa ser do mesmo tipo que está na tabela de referência, porém não posso usar novamente BigIncrements, senão ele criará como chave primária. Preciso alterar o tipo para unsignedBigInteger.
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('products');
    }
}
