<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeletePositiveNegativeColumns extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('messages', function (Blueprint $table) {
      $table->dropColumn('negative_word');
      $table->dropColumn('positive_word');
      $table->boolean('has_sentiment')->after('exact')->nullable();
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
      $table->boolean('negative_word')->nullable();
      $table->boolean('positive_word')->nullable();
      $table->dropColumn('has_sentiment');
    });
  }
}
