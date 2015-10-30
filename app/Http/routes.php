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

// $app->get('/', function () use ($app) {
//   // return $app->welcome();
//   return "Uatu";
// });

$app->post('usermessage', 'MessageController@index');
$app->get('paths', 'MessageController@get_opt_in_paths');