<?php

use Inventory\models\Equipment;

class InventoryTest extends TestCase{
	public function testIsTrue(){
		$this -> assertTrue(true);
	}

	public function testCreateEquipmentWithAllFilledFields(){
		$input = array(
			'serial_number' => '123456789',
			'manufacturer' => 'Cisco',
			'type' => 'Router',
			'model' => 'ASX1200',
			'location' => 'TI240',
			'obtained' => '2014-12-12',
			'warranty' => '2014-12-12'
			);
	
		$response = $this -> call('POST', 'inventory/equipment/create', $input);
		$this -> assertEquals(Equipment::where('model', '=', 'ASX1200')->first()->model, $input['model']);
	}

	public function testIfNoFieldsAreEnteredWhenCreatingEquipment(){
		$input = array();
		$response = $this -> call('POST', 'inventory/equipment/create', $input);
		$this -> assertResponseStatus(400);
	}

	public function testIfAllRequiredFieldsAreEnteredForEquipment(){
		$input = array(
			'serial_number' => '123456789',
			'type' => 'Router',
			'manufacturer' => 'Cisco',
			'location' => 'TI240',
			);
		$response = $this -> call('POST', 'inventory/equipment/create', $input);
		$this -> assertEquals(Equipment::where('serial_number', '=', '123456789')->first()->serial_number, $input['serial_number']);
	}

	// public function testDeleteEquipment(){
	// 	 $id = array('id' => 5);
	// 	 $response = $this -> call('POST', 'inventory/equipment/delete', $id);
	// 	 $this -> assertCount(0, Equipment::find($id));
	// }

	public function testDataReturnsListOfAllEquipment(){
		$response = $this -> call('POST', 'inventory/equipment/data');
		$count = count($response);
		$array = array(Equipment::all());
		$this -> assertCount($count, $array);
	}
}