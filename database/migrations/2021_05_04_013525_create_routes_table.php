<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id');
            $table->float("duration")->nullable(); 
            $table->string("title");
            $table->string("description");
            $table->string("schedule")->nullable();
            $table->float("price")->default(0); 
            $table->enum('privacy', ['public','private']);
            $table->timestamps();

            $table->foreign('owner_id')
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
        Schema::dropIfExists('routes');
    }
}
