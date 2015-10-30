<?php namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Response;

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
   */
  public function sendMessage($opt_in_path, $phone)
  {
    $username = env('MOBILE_COMMONS_USERNAME');
    $password = env('MOBILE_COMMONS_PASSWORD');

    $response = $this->client->request('POST', 'profile_update',
      [
        'auth'  => ['developers@dosomething.org','80276608'],
        'query' => [
          'phone_number'   => $phone,
          'opt_in_path_id' => $opt_in_path,
        ]
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

  /**
   * Gets all of the opt in paths
   * for the pregnancy campaign so we don't have to manually find them all.
   */
  public function getCampaignOptInPaths()
  {
    $username = env('MOBILE_COMMONS_USERNAME');
    $password = env('MOBILE_COMMONS_PASSWORD');

    $response = $this->client->request('GET', 'campaigns',
      [
        'auth'  => ['developers@dosomething.org','80276608'],
        'query' => ['include_opt_in_paths' => 1]
      ]
    );

    $paths = array();
    $campaigns = $response->getBody()->getContents();
    $campaigns = simplexml_load_string($campaigns);
    foreach ($campaigns->campaigns->campaign as $campaign) {
      if ($campaign['id'] == '139384') {
        foreach ($campaign->opt_in_paths->opt_in_path as $path) {
          $id = (string) $path['id'];
          $paths[$id] = (string) $path->name;
        }
      }
    }

    return $paths;
  }
}
