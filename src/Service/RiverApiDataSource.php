<?php

namespace JournalMedia\Sample\ApiProject\Service;

use GuzzleHttp\Exception\GuzzleException;
use JournalMedia\Sample\ApiProject\Connector\JournalApiConnector;

class RiverApiDataSource implements RiverDataSourceInterface
{

    private JournalApiConnector $apiConnector;

    public function __construct(JournalApiConnector $apiConnector)
    {
        $this->apiConnector = $apiConnector;
    }

    /**
     * @throws GuzzleException
     */
    public function getArticlesByPublication(string $publicationName, array $extraOptions = [])
    {
        $response = $this->apiConnector->doGet(DIRECTORY_SEPARATOR . $publicationName);
        return $response['result'] ?? [];
    }

    /**
     * @throws GuzzleException
     */
    public function getArticlesByTag(string $tagName, array $extraOptions = [])
    {
        $response = $this->apiConnector->doGet(DIRECTORY_SEPARATOR . $tagName);
        return $response['result'] ?? [];
    }
}