<?php
namespace JournalMedia\Sample\Factories\Configurations;

use JournalMedia\Sample\Configurations\ConfigurationAbstract;
use JournalMedia\Sample\Configurations\Rivers\TagRiverConfiguration;
use JournalMedia\Sample\Configurations\Rivers\TagRiverFakerConfiguration;
use JournalMedia\Sample\Contracts\FactoryInterface;

/**
 * Class TagRiverConfigurationFactory
 * @package JournalMedia\Sample\Factories\Configurations
 */
class TagRiverConfigurationFactory implements FactoryInterface
{
    private $isDemoMode;

    /**
     * TagRiverConfigurationFactory constructor.
     */
    public function __construct()
    {
        $this->isDemoMode = getenv('DEMO_MODE') === "true";
    }

    /**
     * @return ConfigurationAbstract
     * @throws \Exception
     */
    public function create(): ConfigurationAbstract
    {
        if ($this->isDemoMode) {
            return new TagRiverFakerConfiguration();
        }

        return new TagRiverConfiguration();
    }
}