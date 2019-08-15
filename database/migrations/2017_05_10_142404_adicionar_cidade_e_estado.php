<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarCidadeEEstado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("estado", function (Blueprint $table) {
            $table->bigIncrements("codigo");
            $table->string("nome", 50);
            $table->string("sigla", 2);
            $table->timestamps();
        });

        Schema::create("cidade", function (Blueprint $table) {
            $table->bigIncrements("codigo");
            $table->string("nome", 50);
            $table->bigInteger("codigo_estado")->unsigned();
            $table->timestamps();

            $table->foreign("codigo_estado")
                ->references("codigo")
                ->on("estado");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("cidade");
        Schema::dropIfExists("estado");
    }
}
