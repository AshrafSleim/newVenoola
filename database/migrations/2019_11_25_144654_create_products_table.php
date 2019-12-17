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
            $table->bigIncrements('id');
            $table->string('active')->default('new');
            $table->string('name');
            $table->string('nameAr');
            $table->string('image');
            $table->integer('counter')->default('0');
            $table->string('price');
            $table->integer('category');
            $table->string('type')->nullable();
            $table->string('age')->nullable();
            $table->integer('vendor_id');
            $table->integer('market_id');
            $table->integer('brand_id')->nullable();
            $table->integer('relation_id')->nullable();
            $table->integer('event_id')->nullable();
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
