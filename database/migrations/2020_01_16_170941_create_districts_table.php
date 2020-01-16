<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDistrictsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('districts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('adcode', 191)->comment('行政编码');
			$table->string('name', 191)->comment('名字');
			$table->string('center', 191)->comment('经纬度');
			$table->string('level', 191)->comment('级别');
			$table->integer('parent_id')->default(0);
			$table->integer('sort')->default(0)->comment('排序');
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
		Schema::drop('districts');
	}

}
