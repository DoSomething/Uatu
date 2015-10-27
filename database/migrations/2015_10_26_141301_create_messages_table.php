<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('messages', function (Blueprint $table) {
      $table->increments('id');
      $table->string('type');
      $table->string('message');
      $table->boolean('exact')->nullable();
      $table->boolean('negative_word')->nullable();
      $table->boolean('positive_word')->nullable();
      $table->integer('response_id')->unsigned();
      $table->foreign('response_id')->references('id')->on('responses');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('message');
  }
}
