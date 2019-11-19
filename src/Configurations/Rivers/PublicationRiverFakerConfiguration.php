<?php
namespace JournalMedia\Sample\Configurations\Rivers;

use JournalMedia\Sample\Configurations\ConfigurationAbstract;

/**
 * Class PublicationRiverFakerConfiguration
 * @package JournalMedia\Sample\Configurations\Rivers
 */
class PublicationRiverFakerConfiguration extends ConfigurationAbstract
{
    const RULES_PATH = __DIR__ . '/Rules/faker.json';

    /**
     * PublicationRiverFakerConfiguration constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        try {
            $this->loadRules(self::RULES_PATH);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return string
     */
    public function parameter(): string
    {
        return 'Publication/' .$this->mask() . '.json';
    }

    /**
     * @return string
     */
    public function mask(): string
    {
        return '{name_file}';
    }

    /**
     * @return array
     */
    public function configs(): array
    {
        return ['Content-Type: application/json'];
    }

    /**
     * @param $response
     * @return array
     */
    public function check($response): array
    {
        if (empty($response)) {
            return [];
        }

        return $response;
    }
}