<?php namespace App;

  use Illuminate\Database\Eloquent\Model;

  class Message extends Model
  {
    protected $fillable = [
      'type',
      'message',
      'exact',
      'negative_word',
      'positive_word',
      'response_id',
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
    public static function testRegexMessages($user_message) {
      $regex_messages = self::getRegexMessages();

      foreach ($regex_messages as $regex)
      {
        if (preg_match($regex->message, $user_message)) {
          // @TODO - check sentiment here?
          return $regex->response_id;
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
    public static function testWordMessages($user_message)
    {
      $word_messages = self::getWordMessages();

      foreach ($word_messages as $word) {
        // Check if this word needs to be matched exactly to pass.
        if ($word->exact) {
          // Check if the work meets our levenshtein threshold
          if (levenshtein($user_message, $word->message) <= self::$match_threshold) {
            return TRUE;
          }
        }
        // If we don't need an exact match for the word, check if it exists in the users message at all.
        else {
          if (stripos($user_message, $word->message) !== FALSE) {
            return (self::checkSentiment($word, $user_message)) ? $word->response_id : NULL;
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
    public static function testPhraseMessages($user_message)
    {
      $phrase_messages = self::getPhraseMessages();

      foreach ($phrase_messages as $phrase) {
        if ((stripos($user_message, $phrase->message) !== FALSE) || (levenshtein($user_message, $phrase->message) <= self::$match_threshold)) {
          return (self::checkSentiment($phrase, $user_message)) ? $phrase->response_id : NULL;
        }
      }

      return NULL;
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
      $negativeFormWords = array('no', 'not', 'don\'t', 'can\'t', 'can not', 'do not', 'won\'t', 'doesn\'t', 'didn\'t');

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
  }
