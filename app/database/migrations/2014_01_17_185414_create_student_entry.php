<?php

use Illuminate\Database\Migrations\Migration;

class CreateStudentEntry extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entry', function($table){
			$table -> increments('id') -> unsigned();
			$table -> integer('user_id') -> unsigned();
			$table -> string('class', 6);
			$table -> date('date');
			$table -> time('start_time') -> nullable = true;
			$table -> time('end_time') -> nullable = true;
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
	}

}