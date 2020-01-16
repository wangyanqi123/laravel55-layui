<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('links', function(Blueprint $table)
		{
			$table->increments('id')->comment('主键');
			$table->string('name', 191)->comment('名称');
			$table->string('url', 191)->comment('链接地址');
			$table->string('logo', 191)->nullable()->default('')->comment('链接图片');
			$table->integer('sort')->unsigned()->default(0)->index()->comment('排序');
			$table->boolean('status')->default(0)->index()->comment('是否显示');
			$table->boolean('target')->default(0)->comment('新窗口打开');
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
		Schema::drop('links');
	}

}
