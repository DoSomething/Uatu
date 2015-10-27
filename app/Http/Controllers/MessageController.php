<?php

  namespace App\Http\Controllers;

  use App\Message;
  use App\Response;

  class MessageController extends Controller
  {
    public function index()
    {
      // Get the user message.
      $user_message = $this->args;
      // @TODO - Do some user message sanitization, make it all lower case, common misspellings, slang.
      $match_found = FALSE;

      // Test the message against all of the regex messages.
      if (Message::testPhraseMessages($user_message)) {
        var_dump("phrase");
        $match_found = TRUE;
      }
      else if (Message::testWordMessages($user_message)) {
        var_dump("word");
        $match_found = TRUE;
      }
      else if (Message::testRegexMessages($user_message)) {
        var_dump("regex");
        $match_found = TRUE;
      }

      var_dump($match_found);
    }
  }
