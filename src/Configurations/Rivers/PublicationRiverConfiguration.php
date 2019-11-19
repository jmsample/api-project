<?php
namespace JournalMedia\Sample\Configurations\Rivers;

use JournalMedia\Sample\Configurations\ConfigurationAbstract;

/**
 * Class PublicationRiverConfiguration
 * @package JournalMedia\Sample\Configurations\Rivers
 */
class PublicationRiverConfiguration extends ConfigurationAbstract
{
    const RULES_PATH = __DIR__ . '/Rules/thejournal.json';

    /**
     * PublicationRiverConfiguration constructor.
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
        return 'sample/' . $this->mask();
    }

    /**
     * @return string
     */
    public function mask(): string
    {
        return '{publication}';
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