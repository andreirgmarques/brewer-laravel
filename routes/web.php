<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get("/logout", "Auth\LoginController@logout");

Route::get("/", "DashboardController@dashboard");

Route::group(["prefix" => "cervejas"], function (){
    Route::get("/nova", "CervejasController@nova");
    Route::post("/nova", "CervejasController@salvar");
    Route::get("/", "CervejasController@pesquisar");
});

Route::group(["prefix" => "cidades"], function () {
    Route::get("/nova", "CidadesController@nova");
    Route::post("/nova", "CidadesController@salvar");
    Route::get("/ajax","CidadesController@pesquisarPorCodigoEstado");
    Route::get("/", "CidadesController@pesquisar");
});

Route::group(["prefix" => "clientes"], function () {
    Route::get("/novo", "ClientesController@novo");
    Route::post("/novo", "ClientesController@salvar");
    Route::get("/", "ClientesController@pesquisar");
});

Route::group(["prefix" => "estilos"], function () {
    Route::get("/novo", "EstilosController@novo");
    Route::post("/novo", "EstilosController@salvar");
    Route::post("/salvarAjax", "EstilosController@salvarAjax");
    Route::get("/", "EstilosController@pesquisar");
});

Route::group(["prefix" => "fotos"], function (){
    Route::post("/", "FotosController@upload");
});

Route::group(["prefix" => "usuarios"], function () {
    Route::get("/novo", "UsuariosController@novo");
    Route::post("/novo", "UsuariosController@salvar");
    Route::get("/", "UsuariosController@pesquisar");
});

