<?php

namespace Inventory\models;
use Input, User, Response, Eloquent, Validator;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Contract extends Eloquent{

	protected $table = 'inventory_contract';
	protected $fillable = array('equipment_id', 'type', 'expiration', 'contract_number', 'vendor');
	protected $guarded = array('id');
	public $timestamps = false;

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */

	public function entry(){
		return $this -> belongsTo('Equipment');
	}

	private static $rules = array(
		'equipment_id' => 'required|numeric'
		'type' =>	'required|alpha_num'
		'expiration' =>	'required|date'
		'contract_number' =>	'required|alpha_num'
		'vendor' =>	'required|alpha_num'
		);

	public static function validate($data){
		return Validator::make($data, static::$rules);
	}
}