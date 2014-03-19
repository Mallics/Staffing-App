<?php

namespace GroupStudy\controllers;
use BaseController, Input, User, Response;

class EntryController extends BaseController{
	/**
	 * student_exists
	 * Checks if user exists, if not, calls add_student() and adds the student to the database.
	 * @param  none
	 * @return returns json response
	 */
	 public function student_exists(){
	 	$student_num = substr(Input::get('student_num'), 2, 8);   //used to grab only the student number from the id card.
	 	$class = Input::get('class');
	 	$date = date('Y-m-d');
	 	$student_id = Student::where('student_num', $student_num) -> pluck('id');  
		if(empty($student_id)) 
			return Response::json(array('error' => 'user_does_not_exist', 'student_num' => $student_num, 'class' => $class));
	 	else{
	 		$entry_id = Entry::where('student_id', $student_id) -> where('date', $date) ->    //checks if a start_time has been created for the user
					whereNotNull('start_time') -> whereNull('end_time') -> pluck('id');		  //if not, goes to start_entry, else goes to end_entry
			if(empty($entry_id))
				return $this -> start_entry($student_id, $class, $date);
			else
				return $this -> end_entry($entry_id, $date);
	 	}
	 }
	/**
	 * add_student
	 * Adds the user to the student database and calls start_entry to create an entry and update the start_time timestamp.
	 * @param  none
	 * @return returns json response if user is created or not
	 */
	 public function add_student($student_num){
	 	$input = Input::all();
	 	//$class = Input::get('class');
	 	$date = date('Y-m-d');
	 	$student_arr = array('first_name' => $input['first_name'], 'last_name' => $input['last_name'], 
	 					'student_num' => $student_num);
	 	$student = Student::create($student_arr);
	 	if(empty($student))
	 		return Response::json(array('error' => 'user_not_created'));
	 	else{
	 		return $this -> start_entry($student, $class, $date);
	 	}
	 }
	/**
	 * start_entry
	 * Adds a entry into the entry database and add a start_time timestamp.
	 * @param (int)$student_id: pk for student db, (string)$class, (date) $date: current date
	 * @return json response to add_student that returns the entry created or not created.
	 */
	public function start_entry($student, $class, $date){
		$entry_arr = array(
				'student_id' => $student['id'],
				'class' => $class,
				'date' => $date);
		$entry = Entry::create($entry_arr);
		$entry -> update(array('start_time' => date('H:m:s')));
		if(empty($entry))
			return Response::json(array('error' => 'entry_not_created'));
		else
			return Response::json(array('success' => 'created_in_time'));
		}

	public function end_entry($entry_id, $date){
		if(empty($entry_id))
			return Response::json(array('error' => 'entry_not_found'));
		else{
			Entry::where('id', $entry_id) -> update(array('end_time' => date('H:m:s')));  
			return Response::json(array('success' => 'created_out_time'));
			}
		}

	/**
	 * delete_entry
	 * Checks for entry by PK.  If found, deletes the entry.
	 * @param (int) ($id) PK for entry.
	 * @return (PK) (id) returns json response for error or success
	 */
	public function delete_entry($id){
		$entry = Entry::find($id);
		if(empty($entry)) 
			return Response::json(array('error' => 'entry_not_found'));
		else{
			$entry -> delete();
			return Response::json(array('success' => 'deleted_entry'));
		}
	}

	/**
	 * update_entry
	 * Check for entry by Pk.  If found, allows for updating of certain fields.
	 * @param (int) ($id) PK for entry.
	 * @return (PK) (id) returns json response for error or success
	 */
	public function update_entry($id){
		$input = Input::all();
		$entry = Entry::find($id);
		if(empty($entry))
			return Response::json(array('error' => 'entry_not found'));
		else{

		}
	}
}