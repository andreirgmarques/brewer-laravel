<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaUsuarioGrupoPermissao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("usuario", function (Blueprint $table) {
            $table->bigIncrements("codigo");
            $table->string("nome", 50);
            $table->string("email", 50);
            $table->string("senha", 120);
            $table->boolean("ativo");
            $table->date("data_nascimento")->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });

        Schema::create("grupo", function (Blueprint $table) {
            $table->bigIncrements("codigo");
            $table->string("nome", 50);
            $table->timestamps();
        });

        Schema::create("permissao", function (Blueprint $table) {
            $table->bigIncrements("codigo");
            $table->string("nome", 50);
            $table->timestamps();
        });

        Schema::create("usuario_grupo", function (Blueprint $table) {
            $table->increments("id");
            $table->bigInteger("codigo_usuario")->unsigned();
            $table->bigInteger("codigo_grupo")->unsigned();

            $table->foreign("codigo_usuario")->references("codigo")->on("usuario")->onDelete("cascade");
            $table->foreign("codigo_grupo")->references("codigo")->on("grupo")->onDelete("cascade");
        });

        Schema::create("grupo_permissao", function (Blueprint $table) {
            $table->increments("id");
            $table->bigInteger("codigo_grupo")->unsigned();
            $table->bigInteger("codigo_permissao")->unsigned();

            $table->foreign("codigo_grupo")->references("codigo")->on("grupo")->onDelete("cascade");
            $table->foreign("codigo_permissao")->references("codigo")->on("permissao")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("usuario_grupo");
        Schema::dropIfExists("grupo_permissao");
        Schema::dropIfExists("usuario");
        Schema::dropIfExists("grupo");
        Schema::dropIfExists("permissao");
    }
}
