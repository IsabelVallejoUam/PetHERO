<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('walks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('pet_id');
            $table->date('requested_day');
            $table->integer('minutes_walked')->nullable();
            $table->string('route');
            $table->integer('min_time');
            $table->integer('max_time');
            $table->text('commentary')->nullable();
            $table->foreignId('walker')->nullable();
            $table->enum('status',['pending','active','finished','canceled']);

             $table->foreign('pet_id')
                ->references('id')->on('pets')
                ->onUpdate('cascade')
                ->onDelete('cascade');

                $table->foreign('walker')
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
        Schema::dropIfExists('walks');
    }
}
