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
      if ($respons_message = Message::testPhraseMessages($user_message)) {
        var_dump("phrase");
        var_dump($response_message);
        $match_found = TRUE;
      }
      else if ($response_message = Message::testWordMessages($user_message)) {
        var_dump("word");
        var_dump($response_message);
        $match_found = TRUE;
      }
      else if (Message::testRegexMessages($user_message)) {
        var_dump("regex");
        var_dump($response_message);
        $match_found = TRUE;
      }

      $this->mobile_commons->sendMessage();
    }
  }
