<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateProductsTable extends Migration
{

	public function up()
	{
		Schema::create('products', function(Blueprint $table){
			$table->bigIncrements('id');
			$table->bigInteger('category_id')->unsigned();
			$table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
			$table->string('name');
			$table->string('price');
			$table->string('image');
			$table->enum('status',['1','0'])->default('1');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

		});
	}

	public function down()
	{
		Schema::dropIfExists('products');
	}
}