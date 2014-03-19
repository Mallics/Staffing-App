<?php

namespace GroupStudy\models;
use Input, User, Response;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Entry extends Eloquent{
	protected $table = 'group_study_entry';
	public $timestamps = false;
	protected $fillable = array('student_id', 'class', 'date', 'start_time', 'end_time');
	protected $guarded = array('id');

	public function user(){
		$this -> hasMany('Group_Study_Student', 'foreign_key');
	}
}