<?php

namespace GroupStudy\controllers;
use BaseController, Input, User, Response;

class ReportController extends BaseController
{
	public function get_report()
	{
		$input = Input::all();
		$date = $input['year'] . "-" . $input['month'] . "-" . $input['day'];
		$report;

		switch($input['type']){
			case 'date':
				$report = $this -> date_report($date);
				break;
			case 'class':
				$report = $this -> class_report($input['class']);
				break;
			case 'student_id':
				$report = $this -> student_id_report($input['student_id']);
				break;
		}
		return $report;
	}

	public function date_report($date)
	{
		$report = Entry::join('user', 'entry.user_id', '=', 'user.id') -> where('date', $date) 
							->  select('user.name', 'user.student_id', 'entry.class', 'entry.date', 'entry.start_time', 'entry.end_time') -> get();
		return $report;
	}

	public function class_report($class)
	{
		$report = Entry::join('user', 'entry.user_id', '=', 'user.id') -> where('entry.class', $class) 
							->  select('user.name', 'user.student_id', 'entry.class', 'entry.date', 'entry.start_time', 'entry.end_time') -> get();
		return $report;
	}

	public function student_id_report($student_id)
	{
		$report = Entry::join('user', 'entry.user_id', '=', 'user.id') -> where('user.student_id', $student_id) 
							->  select('user.name', 'user.student_id', 'entry.class', 'entry.date', 'entry.start_time', 'entry.end_time') -> get();
		//$report = DB::table('entry') -> where('student_id', $student_id) -> get();
		return $report;
	}
}