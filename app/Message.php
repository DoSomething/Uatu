<?php namespace App;

  use Illuminate\Database\Eloquent\Model;

  class Message extends Model
  {
    protected $fillable = [
      'type',
      'message',
      'exact',
      'short_term',
      'long_term',
      'has_sentiment',
    ];

    // Max threshold for levenshtein formula matches
    public static $match_threshold = 1;

    /*
    * Gets all the regex messages we can
    * match the user input against.
    */
    public static function getRegexMessages()
    {
      return Message::where('type', '=', 'regex')->get();
    }

    /*
    * Gets all the words we can
    * match the user input against.
    */
    public static function getWordMessages()
    {
      return Message::where('type', '=', 'word')->get();
    }

    /*
    * Gets all the phrases we can
    * match the user input against.
    */
    public static function getPhraseMessages()
    {
      return Message::where('type', '=', 'phrase')->get();
    }

    /*
    * Tests input against regex messages.
    *
    * @param  string  $user_message
    * @return bool
    */
    public static function testRegexMessages($user_message, $mdata_id) {
      $regex_messages = self::getRegexMessages();

      foreach ($regex_messages as $regex)
      {
        if (preg_match($regex->message, $user_message)) {
          // @TODO - check sentiment here?
          return self::determineOptInPath($regex, $mdata_id);
        }
      }

      return NULL;
    }

    /*
    * Tests input against words.
    *
    * @param  string  $user_message
    * @return bool
    */
    public static function testWordMessages($user_message, $mdata_id)
    {
      $word_messages = self::getWordMessages();

      foreach ($word_messages as $word) {
        // Check if this word needs to be matched exactly to pass.
        if ($word->exact) {
          // Check if the work meets our levenshtein threshold
          if (levenshtein($user_message, $word->message) <= self::$match_threshold) {
            return (self::checkSentiment($word, $user_message)) ? self::determineOptInPath($word, $mdata_id) : NULL;
          }
        }
        // If we don't need an exact match for the word, check if it exists in the users message at all.
        else {
          if (stripos($user_message, self::sanitizeMessage($word->message)) !== FALSE) {
            return (self::checkSentiment($word, $user_message)) ? self::determineOptInPath($word, $mdata_id) : NULL;
          }
        }
      }

      return NULL;
    }

    /*
    * Tests input against phrases.
    *
    * @param  string  $user_message
    * @return bool
    */
    public static function testPhraseMessages($user_message, $mdata_id)
    {
      $phrase_messages = self::getPhraseMessages();

      foreach ($phrase_messages as $phrase) {
        if ((strcmp($user_message, self::sanitizeMessage($phrase->message)) == 0) || (stripos($user_message, self::sanitizeMessage($phrase->message)) !== FALSE) || (levenshtein($user_message, $phrase->message) <= self::$match_threshold)) {
          return (self::checkSentiment($phrase, $user_message)) ? self::determineOptInPath($phrase, $mdata_id) : NULL;
        }
      }

      return NULL;
    }

    /*
     * There are two different campagins and different mdatas' and opt-in-paths
     * for each, so we need to figure out which on the users is sending from
     * to figure out which opt in path to choose.
     */
    public static function determineOptInPath($message, $mdata_id) {
      if ($mdata_id == '12368') {
        if ($message == 'default') {
          return '196048';
        }
        else {
          return $message->long_term;
        }
      }
      elseif ($mdata_id == '12388') {
        if ($message == 'default') {
          return '195376';
        }
        else {
          return $message->long_term;
        }
      }
    }

    /*
    * Simply checks if the message has a sentiment tied to it
    * so we can know if we should check if the sentiment has been
    * negated by negative words.
    */
    public static function hasSentiment($message) {
      return ($message->has_sentiment) ? TRUE : FALSE;
    }

    /*
    * Check in negative words exist in a string.
    *
    * @param  string  $message
    * @return bool
    */
    public static function hasNegativeWords($message) {
      $negativeFormWords = array('no', 'not', 'dont', 'cant', 'can not', 'do not', 'wont', 'doesnt', 'didnt');

      foreach ($negativeFormWords as $word) {
        if (stripos($message, $word) !== FALSE) {
          return TRUE;
        }
      }

      return FALSE;
    }

    /*
    * If the message we are matching user input against has sentiment,
    * that can therefore be negated with the use of a negative word in
    * the user input.
    *
    * @param  string  $message
    * @param  string  $user_message
    * @return bool
    */
    public static function checkSentiment($message, $user_message) {
      if (self::hasSentiment($message) && self::hasNegativeWords($user_message)) {
        return FALSE;
      }

      return TRUE;
    }

    /*
     * Cleans input, getting rid of special characters and looking out for
     * common abbreviations that might be used.
     * Written by the man himself, Jon Uy :)
     *
     * @param  string  $message
     */
    public static function sanitizeMessage($message) {
      // Single quote to be removed instead of replacing with whitespace to conserve integrity of word.
      $message = preg_replace('/\'/', '', $message);
      // Remove all non alphanumeric characters from the user message.
      $message = preg_replace('/[^A-Za-z0-9 ]/', ' ', $message);
      // Matches multi-character whitespace with a single space.
      $message = preg_replace('/\s+/', ' ', $message);
      $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

      $abbreviations = array(
        'u' => 'you',
        'ur' => 'your',
        'urself' => 'yourself',
      );
      $words = explode(' ', $message);
      for ($i = 0; $i < count($words); $i++) {
        if(isset($abbreviations[$words[$i]])) {
          $key = $words[$i];
          $words[$i] = $abbreviations[$key];
        }
      }
      $message = implode(' ', $words);
      return strtolower($message);
    }
  }
