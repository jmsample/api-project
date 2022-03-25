<?php


namespace JournalMedia\Sample\ApiProject\Connector;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JetBrains\PhpStorm\ArrayShape;
use Psr\Http\Message\ResponseInterface;

class ApiConnector implements HttpConnectorInterface
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
     * @return ApiConnector
     */
    public function setUsername(string $username): ApiConnector
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $password
     * @return ApiConnector
     */
    public function setPassword(string $password): ApiConnector
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param ClientInterface $client
     * @return ApiConnector
     */
    public function setClient(ClientInterface $client): ApiConnector
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
     */
    #[ArrayShape(['result' => "string"])] public function doGet(string $relativeUrl, array $headers = [], array $data = []): array
    {
        $queryString = empty($data) ? '' : '?' . http_build_query($data);
        return ['result' => $this->doRequest('GET', $relativeUrl . $queryString, $headers, [])->getBody()
            ->getContents()];
    }

    /**
     * @param string $relativeUrl
     * @param array $headers
     * @param array $data
     * @return array
     * @throws GuzzleException
     */
    #[ArrayShape(['result' => "string"])] public function doPost(string $relativeUrl, array $headers = [], array $data = []): array
    {
        return ['result' => $this->doRequest('POST', $relativeUrl, $headers, $data)->getBody()
            ->getContents()];
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
            'Authorization' => ['Basic '.$credentials]
        ];
    }
}