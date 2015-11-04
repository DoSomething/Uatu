<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropResponsesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::drop('responses');
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::create('responses', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('mobile_commons_id');
      $table->timestamps();
    });
  }
}
