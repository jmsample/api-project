<?php
namespace JournalMedia\Sample\Configurations\Rivers;

use JournalMedia\Sample\Configurations\ConfigurationAbstract;

/**
 * Class TagRiverFakerConfiguration
 * @package JournalMedia\Sample\Configurations\Rivers
 */
class TagRiverFakerConfiguration extends ConfigurationAbstract
{
    const RULES_PATH = __DIR__ . '/Rules/faker.json';

    /**
     * TagRiverFakerConfiguration constructor.
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
        return 'Tag/' .$this->mask() . '.json';
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