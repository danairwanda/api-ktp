<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => 'APIkey'], function () use ($router){

	$router->get('v1/colors', [
	    'as'    =>  'colors',
	    'uses'  =>  'ApiController@colors'
	]);

	$router->get('v1/sample-text', [
	    'as'    =>  'sample-text',
	    'uses'  =>  'ApiController@sample_text'
	]);

	$router->post('v1/upload-ktp', [
		'as'	=>	'upload-ktp',
		'uses'	=>	'ApiController@upload_ktp'
	]);

	$router->post('v1/registrasi', [
		'as'	=>	'registrasi',
		'uses'	=>	'ApiController@register'
	]);
}); 
