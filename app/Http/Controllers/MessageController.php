<?php

  namespace App\Http\Controllers;

  use App\Message;
  use App\Response;

  class MessageController extends Controller
  {
    public function index()
    {
      // Get the user message.
      // @TODO - Do some user message sanitization, make it all lower case, common misspellings, slang.
      $user_message = $this->args;

      // Test the message against all of the regex messages.
      if ($matched_response = Message::testPhraseMessages($user_message)) {
        $matched_response = self::getFinalOptInPath($matched_response);
      }
      else if ($matched_response = Message::testWordMessages($user_message)) {
        $matched_response = self::getFinalOptInPath($matched_response);
      }
      else if ($matched_response = Message::testRegexMessages($user_message)) {
        $matched_response = self::getFinalOptInPath($matched_response);
      }

      $this->mobile_commons->sendMessage($matched_response, $this->phone);
      // $this->mobile_commons->getBroadcasts();
    }

    public function getFinalOptInPath($matched_response) {
      $options = explode(',', $matched_response);
      $count = count($options);

      if ($count > 1) {
        $index = array_rand($options);
        return $options[$index];
      }

      return $matched_response;
    }

  }
