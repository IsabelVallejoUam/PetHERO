<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sold_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('pet_owner_id');
            $table->foreignId('store_id');
            $table->foreignId('product_id');

            $table->foreign('pet_owner_id')
                ->references('user_id')->on('pet_owners')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('store_id')
                ->references('id')->on('stores')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')->on('products')
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
        Schema::dropIfExists('sold_products');
    }
}
