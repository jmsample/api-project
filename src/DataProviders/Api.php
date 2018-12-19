<?php
declare(strict_types=1);

namespace JournalMedia\Sample\DataProviders;
use GuzzleHttp\Client as HttpClient;
use JournalMedia\Sample\Interfaces\DataProviderInterface;


class Api implements DataProviderInterface
{
    private $url;
    private $userName;
    private $password;

    public function __construct()
    {
        $this->url = getenv('API_BASE_URL');
        $this->userName = getenv('API_USERNAME');
        $this->password = getenv('API_PASSWORD');
    }

    public function getData($tag = false)
    {
        $data = [];

        $param = $tag ? "tag/".$tag : "thejournal";
        $url = $this->url . "/sample/" . $param;
        try {
            $client =  new HttpClient();
            $response = $client->get( $url, [
                'auth' => [
                    $this->userName,
                    $this->password
                ]
            ]);

            $res = json_decode($response->getBody()->getContents(), true);
            if(array_key_exists('articles', $res['response'])){
                return $res['response']['articles'];
            }

        } catch (\Exception $e) {
            // do something
        }

        return $data;
    }
}
