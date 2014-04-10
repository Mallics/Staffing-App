<?php

namespace Inventory\controllers;
use BaseController, Input, User, Entry, Exception, Inventory\models\Contract, Inventory\models\Equipment, Response;

class ContractController extends BaseController{

	public function postCreate(){
		$input = Input::all();
		$input['equipment_id'] = Equipment::where('serial_number', $input['serial_number']) -> pluck('id');
		$validate = Contract::validate($input);
		if($validate -> fails()){
			return Response::json(array('status' => 400, 'messages' => 'input validation failed', 'error' => $validate -> messages()), 400);
		}
		else{
			try{
				$contract = Contract::create($input);
				return Response::json(array('status' => 201, 'message' => 'created contract'), 201);
			}
			catch(Exception $e){
				return Response::json(array('status' => 400, 'message' => 'failed to create contract', 'error' => $e), 400);
			}
		}
	}

	public function postDelete(){
		$id = Input::get('id');
		try{
			$contract = Contract::findOrFail($id);
			$contract -> delete();
		}
		catch(Exception $e){
			return Response::json(array('status' => 400, 'message' => 'contract not found'), 400);
		}

		return Response::json(array('status' => 201, 'message' => 'contract deleted'), 201);
	}

	public function postUpdate(){
		$input = Input::all();
		$id = Input::get('id');
		$validate = Contract::validate($input);
		if($validate -> fails()){
			return Response::json(array('status' => 400, 'messages' => 'input validation failed', 'error' => $validate -> messages()), 400);
		}
		else{
			try{
				$contract = Contract::findOrFail($id);
				$contract -> update($validatedInput);
			}
			catch(Exception $e){
				return Response::json(array('status' => 400, 'messages' => 'contract not updated', 'error' => $e), 400);
			}
		}
		return Response::json(array('status' => 201, 'messages' => 'contract updated successfully'), 201);
	}

	public function getData(){
		return Response::json(Contract::all());
	}

	public function missingMethod($parameters = array())
	{
		return Response::json(array('status' => 404, 'message' => 'Not found'), 404);
	}
}