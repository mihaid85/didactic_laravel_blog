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
			$table->increments('comment_id', true);
			$table->timestamp('data_created_comment')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('data_modified_comment')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('comment_content', 65535);
			$table->integer('post_id')->index('post_id');
			$table->integer('user_id')->index('user_id');
			$table->integer('parent');
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
