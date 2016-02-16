<?php

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
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('title', 100);
            $table->string('slug', 100);
            $table->decimal('price', 6,2);
            $table->smallInteger('quantity')->unsigned();
            $table->text('abstract');
            $table->text('content');
            $table->enum('status', ['published', 'unpublished'])->default('unpublished');
            $table->dateTime('published_at');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
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
        Schema::drop('products');
    }
}
