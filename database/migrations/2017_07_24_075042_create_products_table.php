<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->string('title')->nullable();
            $table->string('model')->nullable();
            $table->text('desc')->nullable();
            $table->string('image_url')->nullable();
            $table->unsignedInteger('price')->default(0);
            $table->unsignedMediumInteger('quantity')->default(0);
            $table->enum('status', ['Available', 'Not Available', 'Available and Coming Soon']);
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
