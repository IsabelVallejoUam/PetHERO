<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['store','walk','product']);
            $table->text('commentary')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('walker_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('store_id')->nullable();
            $table->float('rate', 4, 2);

            $table->foreign('product_id')
            ->references('id')->on('products')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('user_id')->on('pet_owners')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('walker_id')
            ->references('user_id')->on('walkers')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('store_id')
            ->references('id')->on('stores')
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
        Schema::dropIfExists('reviews');
    }
}
