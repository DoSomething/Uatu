<?php

  namespace App\Http\Controllers;

  use App\Message;
  use App\Response;

  class MessageController extends Controller
  {
    public function index()
    {
      // Get the mdata the users is in.
      $mdata_id = $this->mdata_id;

      if ($this->is_mms_msg) {
        if ($mdata_id == '12368') {
          $matched_response = '195188';
        }
        elseif ($mdata_id == '12388') {
          $matched_response = '195456';
        }

        return $this->mobile_commons->sendMessage($matched_response, $this->phone);
      }

      // Get the user message.
      $user_message = $this->args;
      $user_message = Message::sanitizeMessage($user_message);

      // Test the message against all of the regex messages.
      if ($matched_response = Message::testPhraseMessages($user_message, $mdata_id)) {
        $matched_response = self::getFinalOptInPath($matched_response);
      }
      else if ($matched_response = Message::testWordMessages($user_message, $mdata_id)) {
        $matched_response = self::getFinalOptInPath($matched_response);
      }
      else if ($matched_response = Message::testRegexMessages($user_message, $mdata_id)) {
        $matched_response = self::getFinalOptInPath($matched_response);
      }

      return $this->mobile_commons->sendMessage($matched_response, $this->phone);
    }

    public function getFinalOptInPath($matched_response) {
      $options = explode(',', $matched_response);
      $count = count($options);

      if ($count > 1) {
        $index = array_rand($options);
        return trim($options[$index]);
      }

      return $matched_response;
    }

    /*
    * Grabs all of the opt in paths for the pregnancy text campaign
    * via the mobile commons api.
    *
    * @return JSON
    */
    public function get_opt_in_paths() {
      $paths = $this->mobile_commons->getCampaignOptInPaths($this->campaign_id);
      $path_ids = array();
      foreach ($paths as $key => $message) {
        $message = strtolower($message);
        $path_ids[$key] = $message;
      }

      return response()->json($path_ids);
    }
  }
