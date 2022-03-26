<?php

namespace JournalMedia\Sample\ApiProject\Connector;

use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JetBrains\PhpStorm\ArrayShape;
use JournalMedia\Sample\ApiProject\ApiException;
use Psr\Http\Message\ResponseInterface;

class JournalApiConnector implements HttpConnectorInterface
{
    private string $baseApiUrl;
    private ClientInterface $client;
    private string $username;
    private string $password;

    /**
     * JournalApiConnector constructor.
     * @param string $baseApiUrl
     * @param ClientInterface $client
     */
    public function __construct(string $baseApiUrl, ClientInterface $client)
    {
        $this->baseApiUrl = $baseApiUrl;
        $this->client = $client;
    }

    /**
     * @param string $username
     * @return JournalApiConnector
     */
    public function setUsername(string $username): JournalApiConnector
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $password
     * @return JournalApiConnector
     */
    public function setPassword(string $password): JournalApiConnector
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param ClientInterface $client
     * @return JournalApiConnector
     */
    public function setClient(ClientInterface $client): JournalApiConnector
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @param string $relativeUrl
     * @param array $headers
     * @param array $data
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    #[ArrayShape(['result' => "mixed"])] public function doGet(string $relativeUrl, array $headers = [], array $data = []): array
    {
        $queryString = empty($data) ? '' : '?' . http_build_query($data);
        $response = json_decode($this->doRequest('GET', $relativeUrl . $queryString, $headers, [])->getBody()
            ->getContents(), true);
        return $this->parseResponse($response);
    }

    /**
     * @param string $relativeUrl
     * @param array $headers
     * @param array $data
     * @return array
     * @throws GuzzleException
     * @throws Exception
     */
    #[ArrayShape(['result' => "mixed"])] public function doPost(string $relativeUrl, array $headers = [], array $data = []): array
    {
        $response = json_decode($this->doRequest('POST', $relativeUrl, $headers, $data)->getBody()
            ->getContents());
        return $this->parseResponse($response);
    }

    /**
     * @param string $method
     * @param string $relativeUrl
     * @param array $headers
     * @param array $data
     * @return ResponseInterface
     * @throws GuzzleException
     */
    protected function doRequest(string $method, string $relativeUrl, array $headers, array $data): ResponseInterface
    {
        $options['headers'] = array_merge($this->getAuthorization(), $headers);
        $options['body'] = json_encode($data);
        return $this->client->request($method, $this->baseApiUrl . $relativeUrl, $options);
    }

    /**
     * @return string[][]
     */

    #[ArrayShape(['Authorization' => "string[]"])] protected function getAuthorization(): array
    {
        $credentials = base64_encode($this->username . ':' . $this->password);
        return [
            'Authorization' => ['Basic ' . $credentials]
        ];
    }

    /**
     * @param mixed $response
     * @return array
     * @throws Exception
     */
    #[ArrayShape(['result' => "mixed"])] private function parseResponse(mixed $response): array
    {
        if ($response['status'] ?? false) {
            return ['result' => $response['response']['articles']];
        } else {
            throw new ApiException('Error getting data from API');
        }
    }
}