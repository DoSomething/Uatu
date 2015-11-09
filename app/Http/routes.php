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

/*
 * Main API route that user messages get posted to
 * and then processed for matching.
 *
 * Expects params:
 * args - the user's message.
 * phone - the user's phone number.
 * mdata_id - the mData the user is opted in to.
 */
$app->post('usermessage', 'MobileCommonsController@sendResponse');

/*
 * Just a helper route that lists all the campaign opt in paths.
 *
 * Expects params:
 * campaign_id - the campaign to get opt-in paths for
 */
$app->get('paths', 'MobileCommonsController@getPaths');

/*
 * CRUD routes
 */
$app->get('messages', [
  'middleware' => 'auth', 'as' => 'messages.index', 'uses' => 'MessageController@index'
]);
$app->get('messages/create', [
  'middleware' => 'auth', 'as' => 'messages.create', 'uses' => 'MessageController@create'
]);
$app->post('messages', [
  'middleware' => 'auth', 'as' => 'messages.store', 'uses' => 'MessageController@store'
]);
$app->get('messages/{id}/edit', [
  'middleware' => 'auth', 'as' => 'messages.edit', 'uses' => 'MessageController@edit'
]);
$app->post('messages/{id}', [
  'middleware' => 'auth', 'as' => 'messages.update', 'uses' => 'MessageController@update'
]);
$app->get('messages/{id}/delete', [
  'middleware' => 'auth', 'as' => 'messages.delete', 'uses' => 'MessageController@delete'
]);
$app->delete('messages/{id}', [
  'middleware' => 'auth', 'as' => 'messages.destroy', 'uses' => 'MessageController@destroy'
]);
$app->get('messages/{id}', [
  'middleware' => 'auth', 'as' => 'messages.show', 'uses' => 'MessageController@show'
]);

/*
 * User routes
 */
$app->get('login', [
  'middleware' => 'auth', 'uses' => 'UserController@show'
]);
// $app->get('login', 'UserController@show');
$app->post('login', 'UserController@login');
$app->post('logout', 'UserController@logout');
