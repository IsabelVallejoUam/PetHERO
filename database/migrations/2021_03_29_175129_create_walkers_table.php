<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::create('walkers', function (Blueprint $table) {
            
            
            $table->string("schedule")->nullable();
            $table->string("slogan")->nullable();
            $table->float("rate")->default(0); 
            $table->integer("experience")->nullable();           
            $table->foreignId('user_id')->primary();
            $table->integer("score")->default(0);           

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('walkers');
    }
}
