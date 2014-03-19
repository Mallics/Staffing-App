<?php

namespace GroupStudy\models;
use Input, User, Response;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Student extends Eloquent{

	protected $table = 'group_study_student';
	protected $fillable = array('first_name', 'last_name', 'student_num');
	protected $guarded = array('id');
	public $timestamps = false;

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */

	public function entry(){
		return $this -> belongsTo('Group_Study_Entry');
	}

	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

}