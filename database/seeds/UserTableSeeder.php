<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTableSeeder extends Seeder
{

  public function run()
  {
    DB::table('users')->delete();
    User::create(array(
      'name'     => 'Shae Smith',
      'username' => 'ssmith',
      'email'    => 'ssmith@dosomething.org',
      'password' => Hash::make(env('USER_SHAE_PASS')),
    ));
  }
}
