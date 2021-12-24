<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tb_aulas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('professor');
            $table->integer('duracao');
            $table->integer('qtdemaxalunos');
            $table->time('hora');//hora de inicio das aulas
            $table->date('data');
            
            $table->dateTime('dhinicioaula');//para controle da aplicacao dhinicio aula para comparacao
            $table->dateTime('dhfimaula');   //para controle da aplicacao dhinicio aula para comparacao

            $table->unsignedBigInteger('user_id'); //usuario que criou a aula
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });                
        
        Schema::create('tb_checkin', function (Blueprint $table) { 
            $table->id();           
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('aula_id');
            $table->foreign('aluno_id')->references('id')->on('users');
            $table->foreign('aula_id')->references('id')->on('tb_aulas');            
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
        Schema::dropIfExists('tb_aulas');        
        Schema::dropIfExists('tb_checkin');
    }
}
