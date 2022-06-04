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
            $table->string('product_name_en');
            $table->string('product_name_hi');
            $table->longText('description_en');
            $table->longText('description_hi');
            $table->float('price');
            $table->unsignedInteger('vendor_id')->index();
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('size_applicable')->default(true);
            $table->unsignedInteger('category_id')->index();
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->string('slug');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
