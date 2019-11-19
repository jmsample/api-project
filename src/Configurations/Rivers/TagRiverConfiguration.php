<?php
namespace JournalMedia\Sample\Configurations\Rivers;

use JournalMedia\Sample\Configurations\ConfigurationAbstract;

/**
 * Class TagRiverConfiguration
 * @package JournalMedia\Sample\Configurations\Rivers
 */
class TagRiverConfiguration extends ConfigurationAbstract
{
    const RULES_PATH = __DIR__ . '/Rules/thejournal.json';

    /**
     * TagRiverConfiguration constructor.
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
        return 'sample/tag/' . $this->mask();
    }

    /**
     * @return string
     */
    public function mask(): string
    {
        return '{slug}';
    }

    /**
     * @return array
     */
    public function configs(): array
    {
        $auth = [
            'user_name' => getenv('RIVER_USER_NAME'),
            'password' => getenv('RIVER_PASSWORD')
        ];
        $auth = base64_encode($auth['user_name'] . ':' . $auth['password']);
        return ["Authorization: Basic {$auth}"];
    }

    /**
     * @param $response
     * @return array
     */
    public function check($response): array
    {
        if (! array_key_exists('status', $response)) {
            return [];
        }

        if ($response['status'] != 1) {
            return [];
        }

        return $response['response']['articles'];
    }
}