<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalkersTable extends CreateUsersTable
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::create('walkers', function (Blueprint $table) {
            
            $table->string('schedule')->nullable();
            $table->float('rate')->default(0)->unsigned();
            $table->text('slogan')->nullable();
            $table->integer('experience')->nullable();           
            $table->foreignId('user_id')->unique();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('document')->on('users')
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
