<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritePetOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_pet_owners', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('document');
            $table->foreignId('pet_owner_id');

            $table->foreign('document')
                ->references('user_id')->on('walkers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('pt_owner_id')
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
        Schema::dropIfExists('favorite_pet_owners');
    }
}
