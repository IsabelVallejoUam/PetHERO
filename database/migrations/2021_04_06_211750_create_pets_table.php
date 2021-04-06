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
            $table->enum('type', ["Dog","Cat"]);
            $table->string('race');
            $table->enum('size', ["Small","Medium","Large"]);
            $table->string('color');
            $table->int('age');
            $table->foreignId('owner_id');
            $table->timestamps();

            $table->foreign('owner_id')
                ->references('id')->on('pet_owners')
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
