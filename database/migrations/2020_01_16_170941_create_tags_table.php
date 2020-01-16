<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100)->comment('名称');
			$table->integer('sort')->default(0)->comment('排序');
			$table->timestamps();
			$table->boolean('status')->default(1)->comment('是否显示');
			$table->integer('views')->unsigned()->default(0)->comment('搜索指数');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tags');
	}

}
