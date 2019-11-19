<?php
namespace JournalMedia\Sample\Factories\Configurations;

use JournalMedia\Sample\Configurations\ConfigurationAbstract;
use JournalMedia\Sample\Configurations\Rivers\PublicationRiverConfiguration;
use JournalMedia\Sample\Configurations\Rivers\PublicationRiverFakerConfiguration;
use JournalMedia\Sample\Contracts\FactoryInterface;

/**
 * Class PublicationRiverConfigurationFactory
 * @package JournalMedia\Sample\Factories\Configurations
 */
class PublicationRiverConfigurationFactory implements FactoryInterface
{
    private $isDemoMode;

    /**
     * PublicationRiverConfigurationFactory constructor.
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
            return new PublicationRiverFakerConfiguration();
        }

        return new PublicationRiverConfiguration();
    }
}