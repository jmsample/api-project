<?php
namespace JournalMedia\Sample\Repository;

use GuzzleHttp\Client;
use JournalMedia\Sample\Factory\RiverFactory;

class ApiRiverRepository implements RiverRepositoryInterface
{
    private $client;

    public function __construct()
    {
        $username = getenv('API_BASIC_USERNAME');
        $password = getenv('API_BASIC_PASSWORD');

        $this-> client = new Client([
            'base_uri' => 'https://api.thejournal.ie/v3/sample/',
            'auth' => [$username, $password],
        ]);
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getForPublication()
    {
        return $this->getApiResponse('thejournal');
    }

    /**
     * @param string $tag
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getForTag(string $tag)
    {
        return $this->getApiResponse('tag/' . $tag);
    }

    /**
     * Fetch the response and and return an array of River from the response
     * @param null $endpoint
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException, \Exception
     */
    private function getApiResponse($endpoint = null) {
        try {
            $response = $this-> client->request('GET', $endpoint);
        } catch (\Exception $e) {
            return [];
        }

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('The API datas cannot be fetched');
        }
        
        $response_body = $response->getBody()->getContents();
        $json_datas = json_decode($response_body);

        if (!isset($json_datas->response) || !isset($json_datas->response->articles)) {
            return [];
        }

        return RiverFactory::fromSerializedArticles($json_datas->response->articles);
    }
}
