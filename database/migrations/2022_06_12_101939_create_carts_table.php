<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id')->index();
            $table->foreign('product_id')->references('products')->on('id')->onDelete('cascade');
            $table->unsignedInteger('user_id')->index();
            $table->foreign('user_id')->references('users')->on('id')->onDelete('cascade');
            $table->float('quantity');
            $table->float('price');
            $table->float('total')->nullable();
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
        Schema::dropIfExists('carts');
    }
}
