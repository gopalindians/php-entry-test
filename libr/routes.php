<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.Now create something great!
| example '/search'=>'Controller@method'
*/

$routePaths = [
	'' => 'HomeController@index',
	/*'/handleUserForm' => 'HomeController@postUserForm',*/


	'/api/getStates'              => 'ApiController@getStates',
	'/api/getCategoriesAndSkills' => 'ApiController@getCategoriesAndSkills',
	'/api/getUsers'               => 'ApiController@getUsers',
	'/api/user'                   => 'ApiController@getUser',
	'/api/handleUserForm'         => 'ApiController@postUserForm',


	'/admin'            => 'AdminController@index',
	'/handleAdminLogin' => 'AdminController@postLogin',
	'/admin/dashboard'  => 'AdminController@getDash',
	'/adminLogout'      => 'AdminController@logout',
	'/userDetail'       => 'AdminController@postUserDetail',
	'/allUsers'         => 'AdminController@getMapAllUsers',
];