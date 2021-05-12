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
            $table->enum('species',['dog','cat']);
            $table->string('race');
            $table->foreignId('owner_id');
            $table->string('sex');
            $table->integer('age');
            $table->enum('personality',['calm','friendly','aggressive','shy']);
            $table->text('commentary')->nullable();
            $table->enum('size',['tiny','small','medium','big','giant']);
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
