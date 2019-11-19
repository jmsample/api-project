<?php
namespace JournalMedia\Sample\Services\HttpClient;

use JournalMedia\Sample\Configurations\ConfigurationAbstract;
use JournalMedia\Sample\Contracts\HttpClientInterface;

/**
 * Class HttpClientAbstract
 * @package JournalMedia\Sample\Services\HttpClient
 */
abstract class HttpClientAbstract implements HttpClientInterface
{
    /**
     * @var ConfigurationAbstract
     */
    protected $configuration;
    protected $path = [];

    /**
     * @param ConfigurationAbstract $configuration
     * @return ConfigurationAbstract
     */
    public function setConfiguration(ConfigurationAbstract $configuration): ConfigurationAbstract
    {
        $this->configuration = $configuration;
        return $this->configuration;
    }

    /**
     * @param $parameter
     * @param string $method
     * @return mixed
     * @throws \Exception
     */
    public function get($parameter, $method = 'GET')
    {
        if (! $this->configuration instanceof ConfigurationAbstract) {
            throw new \Exception("configuration is missing");
        }

        $this->setParameter($parameter);
        return $this->load($method);
    }

    /**
     * @param null $parameter
     * @return array
     * @throws \Exception
     */
    private function setParameter($parameter = null): array
    {
        $this->path = $this->configuration->getPath($parameter);
        return $this->path;
    }

    abstract public function load($method);
}