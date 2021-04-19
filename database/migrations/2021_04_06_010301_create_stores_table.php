<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            
            $table->id();
            $table->timestamps();
            $table->foreignId('owner_id');
            $table->string("store_name");
            $table->string("slogan")->nullable();
            $table->string("nit");
            $table->string("description");
            $table->string("schedule")->nullable();
            $table->string('address');
            $table->string('phone_number');
            $table->integer("score")->default(0);           


            $table->foreign('owner_id')
                ->references('user_id')->on('store_owners')
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
        Schema::dropIfExists('store');
    }
}
