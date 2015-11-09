<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function show()
  {
    // show the form
    return View::make('users.login');
  }

  public function login(Request $request)
  {
    $this->validate($request, [
      'email'    => 'required|email',
      'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->has('remember'))) {
      return ['result' => 'ok'];
    }

    return redirect('login');

    // // validate the info, create rules for the inputs
    // $rules = array(
    //   'email'    => 'required|email', // make sure the email is an actual email
    //   'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
    // );

    // // run the validation rules on the inputs from the form
    // $validator = Validator::make($request->all(), $rules);

    // // if the validator fails, redirect back to the form
    // if ($validator->fails()) {
    //   return redirect('login')
    //     ->withErrors($validator) // send back all errors to the login form
    //     ->withInput($request->except('password')); // send back the input (not the password) so that we can repopulate the form
    // }
    // else {
    //   // create our user data for the authentication
    //   $userdata = array(
    //     'email'     => $request->input('email'),
    //     'password'  => $request->input('password')
    //   );

    //   // attempt to do the login
    //   if (Auth::attempt($userdata)) {
    //     // validation successful!
    //     // redirect them to the secure section or whatever
    //     // return Redirect::to('secure');
    //     // for now we'll just echo success (even though echoing in a controller is bad)
    //     echo 'SUCCESS!';
    //   } else {
    //     // validation not successful, send back to form
    //     return redirect('login');
    //   }
    // }
  }

  public function logout()
  {
    Auth::logout();
    return redirect('login'); // redirect the user to the login screen
  }
}
