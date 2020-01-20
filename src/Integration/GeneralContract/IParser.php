<?php


namespace JournalMedia\Sample\Integration\GeneralContract;

/**
 * Interface IParser
 * @package JournalMedia\Sample\Integration\GeneralContract
 *
 * Default contract for all parsers.
 */
interface IParser
{
    /**
     * Parse raw data.
     *
     * @param mixed $rawData
     * @return mixed
     */
    public function parse($rawData);
}