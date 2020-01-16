<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('phone', 100)->comment('手机');
			$table->string('name', 50)->nullable()->comment('昵称');
			$table->string('password')->comment('密码');
			$table->string('avatar')->nullable()->comment('头像');
			$table->string('remember_token', 150)->nullable()->comment('记住我');
			$table->char('uuid', 36);
			$table->softDeletes();
			$table->timestamps();
			$table->string('api_token', 191)->nullable();
			$table->integer('status')->nullable()->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('members');
	}

}
