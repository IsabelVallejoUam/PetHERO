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
            $table->foreignId('user_id');
            $table->date('requested_day');
            $table->time("requested_hour");
            $table->integer('minutes_walked')->nullable();
            $table->foreignId('route');
            $table->integer('min_time');
            $table->integer('max_time');
            $table->text('commentary')->nullable();
            $table->foreignId('walker')->nullable();
            $table->enum('status',['pending','accepted','active','finished','canceled']);
            $table->enum('cancel_confirmation',['yes','no']);
            $table->enum('walker_confirmation',['yes','no']);
            $table->foreign('pet_id')
                ->references('id')->on('pets')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('user_id')->on('pet_owners')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('walker')
            ->references('user_id')->on('walkers')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('route')
                ->references('id')->on('routes')
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
