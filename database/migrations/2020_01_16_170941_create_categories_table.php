<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 20)->comment('名称');
			$table->integer('parent_id')->default(0)->comment('上级ID');
			$table->integer('sort')->default(0)->comment('排序');
			$table->timestamps();
			$table->integer('icon_id')->nullable();
			$table->boolean('status')->default(1)->comment('是否显示');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
