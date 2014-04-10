<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TimeEntryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('time_tracking_entry',function($table) {

            $table->increments('id');
            $table->date('startDate');
            $table->date('endDate')->nullable();
            $table->time('startTime');
            $table->time('endTime')->nullable();
            $table->text('description')->nullable();
            $table->boolean('clock_in')->defalut(false);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

	public function down()
	{

		Schema::drop('time_tracking_entry');
	}

}
