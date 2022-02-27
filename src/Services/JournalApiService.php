<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ApiProject\Services;

use GuzzleHttp\Client;
use JournalMedia\Sample\ApiProject\Helpers\JsonHelper;
use \Exception;

class JournalApiService
{
    private Client $client;
    private JsonHelper $jsonHelper;
    protected int $apiTimeout = 15;
    protected array $clientConfig;
    
    public function __construct(JsonHelper $jsonHelper)
    {
        $this->client = $this->createClient();
        $this->jsonHelper = $jsonHelper;
    }

    /**
     * @param array $configOptions Client configuation options to add or overwrite
     */
    protected function setClientConfig($configOptions = []): void
    {
        $clientConfig = [
            'base_uri' => getenv('API_URL'),
            'auth' => [
                getenv('API_USERNAME'),
                getenv('API_PASSWORD')
            ],
            'headers' => [
                'Content-type' => 'application/json'
            ],
            'timeout' => $this->apiTimeout
        ];

        if (!empty($configOptions)) {
            $clientConfig = array_merge($clientConfig, $configOptions);
        }

        $this->clientConfig = $clientConfig;
    }

    /**
     * @param array $configOptions
     */
    protected function createClient($configOptions = []): Client
    {
        $this->setClientConfig($configOptions);
        return new Client($this->clientConfig);
    }
    
    /**
     * @param string $url The $url to append to the client base URI
     * @param array $params Query paramaters to pass with the request
     */
    public function get(string $url, $params = []): array
    {
        if (!empty($params)) {
            $params = [
                'query' => $params
            ];
        }

        try {
            $response = $this->client->request('GET', $url, $params);
        }
        catch (Exception $e) {
            return $e->getMessage();
        }

        return $this->jsonHelper->toJson($response->getBody()->getContents());
    }
}
