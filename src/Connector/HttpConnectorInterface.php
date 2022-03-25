<?php

namespace JournalMedia\Sample\ApiProject\Connector;

use GuzzleHttp\ClientInterface;

interface HttpConnectorInterface
{
    /**
     * @param ClientInterface $client
     * @return mixed
     */
    public function setClient(ClientInterface $client);

    /**
     * @param string $relativeUrl
     * @param array $headers
     * @param array $data
     * @return array
     */
    public function doPost(string $relativeUrl, array $headers, array $data): array;

    /**
     * @param string $relativeUrl
     * @param array $headers
     * @param array $data
     * @return array
     */
    public function doGet(string $relativeUrl, array $headers, array $data): array;
}