<?php
namespace JournalMedia\Sample\Contracts;

interface ConfigurationInterface
{
    public function loadConfiguration();
    public function getPath($parameterValue);
    public function checkResult($response);
}