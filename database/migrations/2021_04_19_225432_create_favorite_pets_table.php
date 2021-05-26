<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_pets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('walker_id');
            $table->foreignId('pet_id');

            $table->foreign('walker_id')
                ->references('user_id')->on('walkers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('pet_id')
                ->references('id')->on('pets')
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
        Schema::dropIfExists('favorite_pets');
    }
}
