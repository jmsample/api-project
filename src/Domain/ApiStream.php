<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Domain;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Class ApiStream
 */
final class ApiStream implements StreamInterface
{
    /**
     * Publication API origin
     *
     * @var string
     */
    private $origin;

    /**
     * Publication API username
     *
     * @var string
     */
    private $username;

    /**
     * Publication API password
     *
     * @var string
     */
    private $password;

    /**
     * contructor
     *
     * @param string $tag
     */
    public function __construct(string $tag = '')
    {
        $this->origin = 'https://api.thejournal.ie/v3/sample/';
        $this->username = getenv('API_USERNAME');
        $this->password = getenv('API_PASSWORD');
    }

    /**
     * Loads articles from publication endpoint
     *
     * @return array
     */
    public function loadFromPublication() : array
    {  
        return $this->loadStream('/thejournal');
    }

    /**
     * Loads articles for a tag
     *
     * @param string $tag
     * @return array
     */
    public function loadFromTag(string $tag) : array
    {
        return $this->loadStream('/tag/'.$tag);
    }

    /**
     * API request for articles
     *
     * @param string $uri
     * @return array
     * @throws ClientException
     */
    private function loadStream(string $uri) : array
    {
        $result = [];
    
        // guzzle call
        $client = new Client();
        try {
            $response = $client->request('GET', $this->origin.$uri, [
                'auth' => [
                    $this->username, 
                    $this->password
                ]
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
        } catch(ClientException $e) {
            throw $e;
        }

        return $result["response"]["articles"];
    }
}