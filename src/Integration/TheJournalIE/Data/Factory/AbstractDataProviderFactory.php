<?php


namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Factory;

use GuzzleHttp\Client;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\Type\AbstractTypeEnum;

/**
 * AbstractClass AbstractDataProviderFactory
 * @package JournalMedia\Sample\Integration\TheJournalIE\Data\Factory
 */
abstract class AbstractDataProviderFactory
{
    /** @var Client $guzzleClient */
    protected $guzzleClient;

    /**
     * GeneralFactory constructor.
     * @param Client $guzzleClient
     */
    public function __construct(Client $guzzleClient = null)
    {
        if (empty($guzzleClient)) {
            $guzzleClient = new Client;
        }
        $this->guzzleClient = $guzzleClient;
    }


    public abstract function make(AbstractTypeEnum $type);
}