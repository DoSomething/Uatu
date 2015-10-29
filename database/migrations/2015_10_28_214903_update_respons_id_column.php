<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateResponsIdColumn extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('messages', function (Blueprint $table) {
      $table->dropForeign('messages_response_id_foreign');
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
      $table->integer('response_id')->unsigned();
      $table->foreign('response_id')->references('id')->on('responses');
    });
  }
}
