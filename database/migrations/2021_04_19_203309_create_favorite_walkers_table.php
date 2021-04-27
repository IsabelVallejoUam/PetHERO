<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoriteWalkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_walkers', function (Blueprint $table) {
            
            $table->id();
            $table->timestamps();
            $table->foreignId('pet_owner_id');
            $table->foreignId('walker_id');

            $table->foreign('pet_owner_id')
                ->references('user_id')->on('pet_owners')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('walker_id')
                ->references('user_id')->on('walkers')
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
        Schema::dropIfExists('favorite_walkers');
    }
}
