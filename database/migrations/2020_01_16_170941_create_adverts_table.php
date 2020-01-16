<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adverts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 191)->comment('广告标题');
			$table->string('thumb', 191)->comment('图片链接');
			$table->string('link', 191)->nullable()->comment('跳转链接');
			$table->boolean('sort')->default(0)->comment('排序');
			$table->integer('position_id')->comment('位置ID');
			$table->text('description', 65535)->nullable()->comment('广告描述');
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
		Schema::drop('adverts');
	}

}
