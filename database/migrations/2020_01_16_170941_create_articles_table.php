<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id')->nullable()->comment('分类id');
			$table->string('title', 200)->comment('标题');
			$table->string('keywords', 200)->nullable()->default('')->comment('关键词');
			$table->text('description', 65535)->nullable()->comment('描述');
			$table->text('content', 65535)->comment('内容');
			$table->integer('click')->nullable()->default(0)->comment('点击量');
			$table->string('thumb', 200)->nullable()->comment('缩略图');
			$table->timestamps();
			$table->integer('status')->unsigned()->default(1)->comment('是否显示');
			$table->integer('views')->unsigned()->default(0)->comment('浏览数');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articles');
	}

}
