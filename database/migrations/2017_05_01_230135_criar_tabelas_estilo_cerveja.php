<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelasEstiloCerveja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("estilo", function (Blueprint $table) {
            $table->bigIncrements("codigo");
            $table->string("nome", 50);
            $table->timestamps();
        });

        Schema::create("cerveja", function (Blueprint $table) {
            $table->bigIncrements("codigo");
            $table->string("sku", 50);
            $table->string("nome", 80);
            $table->text("descricao");
            $table->decimal("valor", 10, 2);
            $table->decimal("teor_alcoolico", 10, 2);
            $table->decimal("comissao", 10, 2);
            $table->string("sabor", 50);
            $table->string("origem", 50);
            $table->bigInteger("codigo_estilo")->unsigned();
            $table->timestamps();

            $table->foreign("codigo_estilo")
                ->references("codigo")
                ->on("estilo");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("cerveja");
        Schema::dropIfExists("estilo");
    }
}
