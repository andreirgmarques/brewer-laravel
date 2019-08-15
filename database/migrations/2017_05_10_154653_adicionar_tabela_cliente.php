<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarTabelaCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("cliente", function (Blueprint $table) {
            $table->bigIncrements("codigo");
            $table->string("nome", 80);
            $table->string("tipo_pessoa", 15);
            $table->string("cpf_cnpj",30);
            $table->string("telefone",20)->nullable();
            $table->string("email",50);
            $table->string("logradouro",50)->nullable();
            $table->string("numero",15)->nullable();
            $table->string("complemento",20)->nullable();
            $table->string("cep",15)->nullable();
            $table->bigInteger("codigo_cidade")->unsigned()->nullable();
            $table->timestamps();

            $table->foreign("codigo_cidade")
                ->references("codigo")
                ->on("cidade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("cliente");
    }
}
