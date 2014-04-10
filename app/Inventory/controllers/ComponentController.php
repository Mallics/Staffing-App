<?php

namespace Inventory\controllers;
use BaseController, Input, User, Entry, Exception, Inventory\models\Component, Inventory\models\Equipment, Response;

class ComponentController extends BaseController{
		
	public function postCreate(){
		$input = Input::all();
		$input['equipment_id'] = Equipment::where('serial_number', $input['serial_number']) -> pluck('id');
		$validate = Course::validate($input);
		if($validate -> fails()){
			return Response::json(array('status' => 400, 'messages' => 'input validation failed', 'error' => $validate -> messages()), 400);
		}
		else{
			try{
				$component = Component::create($input);
				return Response::json(array('status' => 201, 'message' => 'created component'), 201);
			}
			catch(Exception $e){
				return Response::json(array('status' => 400, 'message' => 'failed to create component', 'error' => $e), 400);
			}
		}
	}

	public function postDelete(){
		$input = Input::get('id');
		try{
			$component = Component::findOrFail($id);
			$component -> delete();
		}
		catch(Exception $e){
			return Response::json(array('status' => 400, 'message' => 'component_not_found', 'error' => $e), 400);
		}

		return Response::json(array('status' => 201, 'message' => 'component deleted'), 201);
	}

	public function postUpdate(){
		$input = Input::all();
		$id = Input::get('id');
		$validate = Component::validate($input);
		if($validate -> fails()){
			return Response::json(array('status' => 400, 'messages' => 'input validation failed', 'error' => $validate -> messages()), 400);
		}
		else{
			try{
				$component = Component::findOrFail($id);
				$component -> update($validatedInput);
			}
			catch(Exception $e){
				return Response::json(array('status' => 400, 'messages' => 'component not updated', 'error' => $e), 400);
			}
		}
		return Response::json(array('status' => 201, 'messages' => 'component updated successfully'), 201);
	}

	public function getData(){
		return Response::json(Component::all());
	}

	public function missingMethod($parameters = array())
	{
		return Response::json(array('status' => 404, 'message' => 'Not found'), 404);
	}
}