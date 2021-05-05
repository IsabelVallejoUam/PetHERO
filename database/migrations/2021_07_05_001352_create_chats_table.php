<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('walk');
            $table->foreignId('walker_id');
            $table->foreignId('petOwner_id');

            $table->foreign('walk')
                ->references('id')->on('walks')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('walker_id')
            ->references('user_id')->on('walkers')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('petOwner_id')
            ->references('user_id')->on('pet_owners')
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('chats');
    }
}
