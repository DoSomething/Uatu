<?php

  namespace App\Http\Controllers;

  use App\Message;

  class MobileCommonsController extends Controller
  {
    public function sendResponse()
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

      // Test phrase messages.
      if ($matched_response = Message::testPhraseMessages($user_message, $mdata_id)) {
        $matched_response = self::getFinalOptInPath($matched_response);
      }
      // Test word messages.
      else if ($matched_response = Message::testWordMessages($user_message, $mdata_id)) {
        $matched_response = self::getFinalOptInPath($matched_response);
      }
      // Test regex messages.
      else if ($matched_response = Message::testRegexMessages($user_message, $mdata_id)) {
        $matched_response = self::getFinalOptInPath($matched_response);
      }
      // No match found message.
      else {
        $matched_response = Message::determineOptInPath('default', $mdata_id);
      }

      return $this->mobile_commons->sendMessage($matched_response, $this->phone);
    }

    /*
     * If there are multiple response options, this function will
     * select a random one to use.
     *
     * @param string $matched_response - A string of opt-in path IDs.
     */
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
    public function getPaths() {
      $paths = $this->mobile_commons->getCampaignOptInPaths($this->campaign_id);
      $path_ids = array();
      foreach ($paths as $key => $message) {
        $message = strtolower($message);
        $path_ids[$key] = $message;
      }

      return response()->json($path_ids);
    }
  }
