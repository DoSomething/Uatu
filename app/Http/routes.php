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
  'as' => 'messages.index', 'uses' => 'MessageController@index'
]);
$app->get('messages/create', [
  'as' => 'messages.create', 'uses' => 'MessageController@create'
]);
$app->post('messages', [
  'as' => 'messages.store', 'uses' => 'MessageController@store'
]);
$app->get('messages/{id}/edit', [
  'as' => 'messages.edit', 'uses' => 'MessageController@edit'
]);
$app->post('messages/{id}', [
  'as' => 'messages.update', 'uses' => 'MessageController@update'
]);
$app->get('messages/{id}/delete', [
  'as' => 'messages.delete', 'uses' => 'MessageController@delete'
]);
$app->delete('messages/{id}', [
  'as' => 'messages.destroy', 'uses' => 'MessageController@destroy'
]);
$app->get('messages/{id}', [
  'as' => 'messages.show', 'uses' => 'MessageController@show'
]);
