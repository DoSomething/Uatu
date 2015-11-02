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
$app->post('usermessage', 'MessageController@index');

/*
 * Just a helper route that lists all the campaign opt in paths.
 *
 * Expects params:
 * campaign_id - the campaign to get opt-in paths for
 */
$app->get('paths', 'MessageController@getPaths');
