<?php


namespace JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Requester;

use GuzzleHttp\Client as GuzzleClient;

/**
 * Class AbstractRequester
 * @package JournalMedia\Sample\Integration\TheJournalIE\Data\Provider\Requester
 */
class AbstractRequester
{
    /** @var GuzzleClient $guzzleClient */
    protected $guzzleClient;

    /**
     * ListArticlesByTag constructor.
     * @param GuzzleClient $guzzleClient
     */
    public function __construct(GuzzleClient $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }
}