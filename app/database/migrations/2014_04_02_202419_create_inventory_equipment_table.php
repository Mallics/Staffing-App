<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryEquipmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventory_equipment', function($table){
			$table->increments('id');
			$table->string('serial_number');
			$table->string('type');
			$table->string('manufacturer');
			$table->string('model') -> nullable();
			$table->string('location');
			$table->date('obtained')->nullable();
			$table->date('warranty')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inventory_equipment');
	}

}
