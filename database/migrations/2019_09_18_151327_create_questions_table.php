<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {   //Design Schema

        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');
            $table->unsignedinteger('views')->default(0);//unsigenInteger means 
            $table->unsignedinteger('answers')->default(0); //positive
            $table->integer('votes')->default(0);
            $table->unsignedinteger('best_answer_id')->nullable();
            $table->unsignedinteger('user_id');
            $table->timestamps();


//   making foreign key for relation user and question database id
            $table->foreign('user_id')->references('id')->on('users')
                   ->onDelete('cascade');

             

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
