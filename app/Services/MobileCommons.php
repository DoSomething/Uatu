<?php namespace App\Services;

use GuzzleHttp\Client;

class MobileCommons
{

  protected $client;

  /**
   * Connect to the Mobile Commons API
   *
   */
  public function __construct()
  {
    $mobile_commons_url = env('MOBILE_COMMONS_URL');
    $company_key = env('MOBILE_COMMONS_COMPANY_KEY');

    $this->client = new Client([
      'base_uri' => $mobile_commons_url,
    ]);
  }

  /**
   * Send message to mobile commons
   *
   */
  public function sendMessage()
  {
    $username = env('MOBILE_COMMONS_USERNAME');
    $password = env('MOBILE_COMMONS_PASSWORD');

    $response = $this->client->request('POST', 'send_message',
      [
        'auth' => [$username, $password]
      ]
    );
  }

  /**
   * get the 'success' attribute from the xml repsonse.
   */
  public function isSuccessful($response)
  {
    $content = $response->getBody()->getContents();
    $content = new \SimpleXMLElement($content);

    if ((string) $content['success'] == 'false') {
      return FALSE;
    }
    else {
      return TRUE;
    }
  }
}
