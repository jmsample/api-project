<?php

namespace JournalMedia\Sample\ApiProject\Application;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Client\ClientInterface;

final class RemoteClient implements HomePageRiverClient, TagRiverClient
{
    private string $basePath;
    private string $username;
    private string $password;
    private GuzzleClient $client;

    public function __construct(string $basePath, string $username, string $password, ?ClientInterface $client = null)
    {
        $this->basePath = $basePath;
        $this->username = $username;
        $this->password = $password;
        $this->client = $client ?? new GuzzleClient();
    }

    public function requestHomePageRiver(string $identifier): string
    {
        $fullUrl = $this->basePath . $identifier;
        return $this->request($fullUrl);
    }

    public function requestTagRiver(string $identifier): string
    {
        $fullUrl = $this->basePath . '/tag/' . $identifier;
        return $this->request($fullUrl);
    }

    private function request(string $fullUrl):string {
        try {

            $response = $this->client->get($fullUrl, ['auth' => [$this->username, $this->password]]);

            if ($response->getStatusCode() == 200) {
                $content = $response->getBody()->getContents();
                $jsonContent = json_decode($content, true);
                return json_encode($jsonContent['response']['articles']);
            }

            throw new \RuntimeException("Please retry");
        } catch (GuzzleException $e) {
            throw new \RuntimeException("Cannot retrieve articles", $e);
        } catch (\Exception $e) {
            throw new \RuntimeException("No Articles found", $e);
        }
    }
}
