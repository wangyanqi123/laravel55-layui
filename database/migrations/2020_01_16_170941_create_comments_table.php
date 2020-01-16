<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->increments('id')->comment('主键');
			$table->integer('article_id')->unsigned()->index('comments_post_id_index')->comment('文章id');
			$table->integer('member_id')->unsigned()->index('comments_user_id_index')->comment('用户id');
			$table->string('content', 191)->comment('评论内容');
			$table->integer('at_id')->unsigned()->default(0)->index()->comment('回复评论id');
			$table->string('ip', 191)->comment('评论ip');
			$table->boolean('read')->default(0)->index()->comment('是否已读');
			$table->boolean('status')->default(0)->index()->comment('是否显示');
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
		Schema::drop('comments');
	}

}
