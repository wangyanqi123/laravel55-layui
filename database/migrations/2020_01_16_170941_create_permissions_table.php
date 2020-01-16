<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permissions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('guard_name', 191);
			$table->string('display_name', 191);
			$table->string('route', 191)->nullable()->comment('路由名称');
			$table->integer('icon_id')->nullable()->comment('图标ID');
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
		Schema::drop('permissions');
	}

}
