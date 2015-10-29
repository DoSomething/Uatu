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
  public function sendMessage($message, $phone)
  {
    $username = env('MOBILE_COMMONS_USERNAME');
    $password = env('MOBILE_COMMONS_PASSWORD');

    $response = $this->client->request('POST', 'send_message',
      [
        'auth' => [$username, $password]
      ]
    );

    return $response;
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

  public function getBroadcasts()
  {
    $username = env('MOBILE_COMMONS_USERNAME');
    $password = env('MOBILE_COMMONS_PASSWORD');

    $response = $this->client->request('GET', 'broadcasts',
      [
        'auth' => [$username, $password],
        'query' => ['campaign_id' => '139384'],
      ]
    );

    // var_dump($response->getBody()->getContents());
  }

}
