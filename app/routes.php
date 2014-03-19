<?php



// use Lotto\hello;

// echo hello::talk();

// exit;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

// ---------------- Testing pages ------------- //



// ----------------------------------------------------------

Route::group(array('prefix' => 'lotto/'), function(){
	Route::get('course', function()
	{
		return View::make('courseForm');
	});

Route::get('entry', function()
	{
		return View::make('entryForm');
	});

Route::get('user', function()
	{
		return View::make('userForm');
	});

Route::get('staff', function()
	{
		return View::make('staffForm');
	});


Route::get('userSkill', function()
	{
		return View::make('userSkill');
	});


Route::get('userStaff', function()
	{
		return View::make('userStaff');
	});

});

// use Lotto\controllers\CourseController;

// Route::match(array('POST', 'GET'), 'createCourse', 'Lotto\controllers\CourseController@create'); 
Route::match(array('POST', 'GET'), 'createCourse', 'CourseController@create'); 
Route::match(array('POST', 'GET'), 'deleteCourse', 'CourseController@delete'); // (id)
Route::match(array('POST', 'GET'), 'getCourse', 'CourseController@get'); // (id) or () Also grabs the labaides
Route::match(array('POST', 'GET'), 'removeLabAide', 'CourseController@removeLabAide'); // (user, course)
Route::match(array('POST', 'GET'), 'setLabAide', 'CourseController@setLabAide'); // (user, course)
Route::match(array('POST', 'GET'), 'updateCourse', 'CourseController@update');

Route::match(array('POST', 'GET'), 'getSkill', 'SkillController@get');
Route::match(array('POST', 'GET'), 'getUserSkill', 'SkillController@getUserSkill');
Route::match(array('POST', 'GET'), 'removeUserSkill', 'SkillController@deleteUserSkill');
Route::match(array('POST', 'GET'), 'setUserSkill', 'SkillController@setUserSkill');


Route::match(array('POST', 'GET'), 'createStaffType', 'StaffTypeController@create');
Route::match(array('POST', 'GET'), 'deleteStaffType', 'StaffTypeController@delete');
Route::match(array('POST', 'GET'), 'getStaffType', 'StaffTypeController@get');
Route::match(array('POST', 'GET'), 'getUserStaffType', 'StaffTypeController@getUserStaffType');
Route::match(array('POST', 'GET'), 'removeUserStaffType', 'StaffTypeController@removeUserStaffType');
Route::match(array('POST', 'GET'), 'setUserStaffType', 'StaffTypeController@setUserStaffType');

Route::match(array('POST', 'GET'), 'deleteUser', 'UserController@delete');
Route::match(array('POST', 'GET'), 'getUser', 'UserController@get');

Route::match(array('POST', 'GET'), 'createEntry', 'EntryController@create');
Route::match(array('POST', 'GET'), 'getEntry', 'EntryController@get');
Route::match(array('POST', 'GET'), 'deleteEntry', 'EntryController@delete');
Route::match(array('POST', 'GET'), 'removeEntryFromUser', 'EntryController@removeEntryFromUser');
Route::match(array('POST', 'GET'), 'setEntryToUser', 'EntryController@setEntryToUser');

Route::post('setUser', 'UserController@set');

//-------------------------------------------------------------------------------------------------------------------------
//Group Study Tracker

Route::group(array('prefix' => 'group_study/'), function(){

	Route::match(array('POST', 'GET'), '/group_study/add_student', 'EntryController@add_student');

	Route::match(array('POST', 'GET'), '/group_study/student_exists', 'EntryController@student_exists');

	Route::match(array('POST', 'GET'), '/group_study/get_report', 'ReportController@get_report');

	Route::match(array('POST', 'GET'), '/group_study/delete_student', 'EntryController@delete_student');

	Route::match(array('POST', 'GET'), '/group_study/modify_student', 'EntryController@modify_student');
	
});

