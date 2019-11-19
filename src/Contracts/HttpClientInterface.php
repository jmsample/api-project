<?php
namespace JournalMedia\Sample\Contracts;

use JournalMedia\Sample\Configurations\ConfigurationAbstract;

interface HttpClientInterface
{
    public function setConfiguration(ConfigurationAbstract $configuration);
    public function get($parameter, $method);
}