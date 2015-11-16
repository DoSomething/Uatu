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
  public function sendMessage($opt_in_path, $phone, $test = FALSE)
  {
    if (!$test) {
      $username = env('MOBILE_COMMONS_USERNAME');
      $password = env('MOBILE_COMMONS_PASSWORD');

      $response = $this->client->request('POST', 'profile_update',
        [
          'auth'  => [$username, $password],
          'query' => [
            'phone_number'   => $phone,
            'opt_in_path_id' => $opt_in_path,
          ]
        ]
      );
    }

    $json_response = array(
      'success' => (isset($response)) ? self::isSuccessful($response) : 'success',
      'opt_in_path' => $opt_in_path,
      'phone' => $phone,
    );

    return response()->json($json_response);
  }

  /**
   * Get the 'success' attribute from the xml repsonse.
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
  public function getCampaignOptInPaths($campaign_id)
  {
    $username = env('MOBILE_COMMONS_USERNAME');
    $password = env('MOBILE_COMMONS_PASSWORD');

    $response = $this->client->request('GET', 'campaigns',
      [
        'auth'  => [$username, $password],
        'query' => ['include_opt_in_paths' => 1]
      ]
    );

    $paths = array();
    $campaigns = $response->getBody()->getContents();
    $campaigns = simplexml_load_string($campaigns);
    foreach ($campaigns->campaigns->campaign as $campaign) {
      if ($campaign['id'] == $campaign_id) {
        foreach ($campaign->opt_in_paths->opt_in_path as $path) {
          $id = (string) $path['id'];
          $paths[$id] = (string) $path->name;
        }
      }
    }

    return $paths;
  }
}
