<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShortAndLongTermResponses extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('messages', function (Blueprint $table) {
      $table->renameColumn('response_id', 'short_term');
      $table->string('long_term');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('messages', function (Blueprint $table) {
      $table->dropColumn('long_term');
    });
  }
}
