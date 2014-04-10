<?php

namespace Inventory\models;
use Input, User, Response, Eloquent, Validator;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Equipment extends Eloquent{

	protected $table = 'inventory_equipment';
	protected $fillable = array('serial_number', 'manufacturer', 'model', 'location', 'obtained', 'warranty', 'type');
	protected $guarded = array('id');
	public $timestamps = false;
	public $incrementing = false;
	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */

	public function contract(){
		return $this -> hasMany('Contract');
	}

	public function component(){
		return $this -> hasMany('Component');
	}

	private static $rules = array(
		'serial_number' => 'required|numeric',
		'manufacturer' =>	'required|alpha_num',
		'type' => 'required|alpha',
		'model' =>	'alpha_num',
		'location' =>	'required|alpha_num',
		'obtained' =>	'date',
		'warranty' =>    'date'
		);

	public static function validate($data){
		return Validator::make($data, static::$rules);
	}
}