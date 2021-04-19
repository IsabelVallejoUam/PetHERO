<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            
            $table->id();
            $table->timestamps();
            $table->string('slogan')->nullable();
            $table->foreignId('store_id');
            $table->float('price')->unsigned();
            $table->string('name');
            $table->float('discount')->default(0)->unsigned();
            $table->integer('quantity')->default(0)->unsigned();
            $table->string('description');
            $table->string('image_url');
            $table->integer("score")->default(0);           


            
            $table->foreign('store_id')
                ->references('id')->on('stores')
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
        Schema::dropIfExists('product');
    }
}
