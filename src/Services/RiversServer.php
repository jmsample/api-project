<?php
namespace JournalMedia\Sample\Services;

use JournalMedia\Sample\Configurations\ConfigurationAbstract;
use JournalMedia\Sample\Services\HttpClient\HttpClientAbstract;

/**
 * Class RiversServer
 * @package JournalMedia\Sample\Services
 */
class RiversServer
{
    /**
     * @var HttpClientAbstract
     */
    private $httpClient;

    /**
     * @var ConfigurationAbstract
     */
    private $configuration;

    /**
     * RiversServer constructor.
     * @param HttpClientAbstract $httpClient
     * @param ConfigurationAbstract $configurarion
     */
    public function __construct(HttpClientAbstract $httpClient, ConfigurationAbstract $configurarion)
    {
        $this->httpClient = $httpClient;
        $this->configuration = $configurarion;
    }

    /**
     * @param $parameter
     * @return array
     * @throws \Exception
     */
    public function load($parameter): array
    {
        $this->httpClient->setConfiguration($this->configuration);
        return $this->configuration->checkResult(json_decode($this->httpClient->get($parameter), true));
    }
}