<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('species');
            $table->string('race');
            $table->foreignId('owner_id');
            $table->enum('sex',['f','m']);
            $table->date('birthday');
            $table->integer('personality');
            $table->text('commentary')->nullable();
            $table->integer('size');
            $table->string('photo')->default('default.png');   
            $table->timestamps();

            $table->foreign('owner_id')
                ->references('user_id')->on('pet_owners')
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
        Schema::dropIfExists('pets');
    }
}
