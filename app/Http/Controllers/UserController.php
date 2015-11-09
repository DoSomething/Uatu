<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  /*
   * Show the login form.
   */
  public function show()
  {
    return View::make('users.login');
  }

  /*
   * Log the user in.
   */
  public function login(Request $request)
  {
    $this->validate($request, [
      'email'    => 'required|email',
      'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->has('remember'))) {
      return redirect('messages');
    }

    return redirect('login');
  }

  /*
   * Logout a user.
   */
  public function logout()
  {
    Auth::logout();
    return redirect('login');
  }
}
