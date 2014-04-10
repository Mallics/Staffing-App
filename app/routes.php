<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/


Route::match(array('POST', 'GET'), 'login', 'UserController@postLogin');
Route::match(array('POST', 'GET'), 'logout', 'UserController@postLogout');
// Route::match(array('POST', 'GET'), 'asd', 'Lotto\controllers\CourseController@getImport');

View::name('layouts.layout', 'layout');
$layout = View::of('layout');

Route::get('/', function() use($layout) {
	return $layout->nest('content', 'home');
});



Route::group(array('before' => 'auth'), function()
{

	
	Route::controller('user', 'UserController');
	
	Route::group(array('prefix' => 'lotto/'), function(){

		Route::controller('course', 'Lotto\controllers\CourseController');
		Route::controller('skill', 'Lotto\controllers\SkillController');
		Route::controller('availability', 'Lotto\controllers\AvailabilityController');
	});

	Route::group(array('prefix' => 'group_study/'), function(){

		Route::controller('entry', 'GroupStudy\controllers\EntryController');
		Route::controller('report', 'GroupStudy\controllers\ReportController');

		Route::match(array('GET', 'POST'), '/checkPunchedIn', 'GroupStudy\controllers\EntryController@checkPunchedIn');
		Route::match(array('GET', 'POST'), '/StartEntry', 'GroupStudy\controllers\EntryController@StartEntry');

	});

	Route::group(array('prefix' => 'calendar/'), function() {

		Route::controller('entries', 'Calendar\controllers\EntriesController');
	});

	Route::group(array('prefix' => 'inventory/'), function() {
		Route::controller('equipment', 'Inventory\controllers\EquipmentController');
		Route::controller('component', 'Inventory\controllers\ComponentController');
		Route::controller('contract', 'Inventory\controllers\ContractController');
	});

});